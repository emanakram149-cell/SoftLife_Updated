<?php
require_once __DIR__ . '/../includes/helpers.php';
setHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') fail('POST only.');

$b        = body();
$email    = filter_var(trim($b['email']    ?? ''), FILTER_SANITIZE_EMAIL);
$password = $b['password'] ?? '';

// ── VALIDATE INPUTS ──
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) fail('Invalid email.');
if (!$password) fail('Password required.');

$db = getDB();

// ── RATE LIMITING — block IP after 5 failed attempts within 15 minutes ──
$ip     = substr($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1', 0, 45);
$window = date('Y-m-d H:i:s', strtotime('-15 minutes'));

$stCheck = $db->prepare(
    'SELECT COUNT(*) AS cnt FROM failed_logins WHERE ip_address = ? AND attempted_at > ?'
);
$stCheck->execute([$ip, $window]);
$failRow = $stCheck->fetch();

if ($failRow && (int)$failRow['cnt'] >= 5) {
    fail('Too many failed login attempts. Please wait 15 minutes before trying again.', 429);
}

// ── FIND USER ──
$st = $db->prepare('SELECT * FROM users WHERE email = ?');
$st->execute([$email]);
$user = $st->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    $db->prepare('INSERT INTO failed_logins (ip_address, attempted_at) VALUES (?, NOW())')
       ->execute([$ip]);
    fail('Incorrect email or password.');
}

// ── CLEAR FAILED ATTEMPTS ──
$db->prepare('DELETE FROM failed_logins WHERE ip_address = ?')->execute([$ip]);

// ── DELETE EXPIRED SESSIONS ──
$db->prepare('DELETE FROM sessions WHERE user_id = ? AND expires_at < NOW()')
   ->execute([$user['id']]);

// ── CREATE DB SESSION + START PHP SESSION ──
$token   = makeToken();
$expires = date('Y-m-d H:i:s', strtotime('+30 days'));
$db->prepare('INSERT INTO sessions (token, user_id, expires_at) VALUES (?, ?, ?)')
   ->execute([$token, $user['id'], $expires]);

if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['sl_user_id'] = (int)$user['id'];
$_SESSION['sl_token']   = $token;

ok([
    'token' => $token,
    'user'  => [
        'id'       => (int) $user['id'],
        'username' => $user['username'],
        'fullname' => $user['fullname'] ?? '',
        'email'    => $user['email'],
        'gender'   => $user['gender'],
        'country'  => $user['country'] ?? '',
    ],
]);
