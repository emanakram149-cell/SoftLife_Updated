<?php
require_once __DIR__ . '/../includes/helpers.php';
setHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') fail('POST only.');

$b        = body();
$username = clean($b['username'] ?? '', 15);
$fullname = clean($b['fullname'] ?? '', 100);
$email    = filter_var(trim($b['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$password = $b['password'] ?? '';
$gender   = $b['gender']   ?? 'default';
$country  = clean($b['country'] ?? '', 60);

// ── 1. RESERVED USERNAMES ──
$reserved = ['admin', 'administrator', 'root', 'superuser', 'moderator', 'mod', 'system'];
if (in_array(strtolower($username), $reserved))
    fail('Username "' . htmlspecialchars($username) . '" is reserved and not allowed.');

// ── 2. USERNAME: must start with a letter, only letters+numbers+underscore ──
if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{3,14}$/', $username))
    fail('Username must start with a letter and be 4–15 characters (letters, numbers, underscore only). Example: Kashif123');

// ── 3. FULL NAME: must start with alphabet, no special chars, min 2 chars ──
if ($fullname !== '') {
    if (!preg_match('/^[A-Za-z][A-Za-z0-9 ]{1,99}$/', $fullname))
        fail('Full name must start with a letter. Special characters are not allowed. Example: Kashif Ahmad');
}

// ── 4. EMAIL ──
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    fail('Invalid email address.');

// ── 5. GENDER ──
if (!in_array($gender, ['male', 'female', 'default']))
    fail('Please select a valid gender.');

// ── 6. COUNTRY ──
$allowed_countries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Chad','Chile','China','Colombia','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Ecuador','Egypt','El Salvador','Estonia','Ethiopia','Fiji','Finland','France','Georgia','Germany','Ghana','Greece','Guatemala','Guinea','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Lithuania','Luxembourg','Malaysia','Maldives','Mali','Malta','Mexico','Moldova','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','Norway','Oman','Pakistan','Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Senegal','Serbia','Sierra Leone','Singapore','Slovakia','Slovenia','Somalia','South Africa','South Korea','Spain','Sri Lanka','Sudan','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
if ($country !== '' && !in_array($country, $allowed_countries))
    fail('Please select a valid country from the list.');

// ── 7. PASSWORD ──
if (strlen($password) < 8 || strlen($password) > 72)
    fail('Password must be 8-72 characters.');
if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password))
    fail('Password must contain both letters and numbers.');

$db = getDB();

// ── 8. CHECK DUPLICATES ──
$st = $db->prepare('SELECT id FROM users WHERE email = ? OR username = ?');
$st->execute([$email, $username]);
if ($st->fetch()) fail('Email or username already registered. Please use a different one.');

// ── 9. CREATE USER ──
$hash = password_hash($password, PASSWORD_BCRYPT);
$st   = $db->prepare('INSERT INTO users (username, fullname, email, password, gender, country) VALUES (?, ?, ?, ?, ?, ?)');
$st->execute([$username, $fullname, $email, $hash, $gender, $country]);
$userId = (int) $db->lastInsertId();

// ── 10. START PHP SESSION + CREATE DB SESSION ──
if (session_status() === PHP_SESSION_NONE) session_start();
$token   = makeToken();
$expires = date('Y-m-d H:i:s', strtotime('+30 days'));
$db->prepare('INSERT INTO sessions (token, user_id, expires_at) VALUES (?, ?, ?)')
   ->execute([$token, $userId, $expires]);

$_SESSION['sl_user_id'] = $userId;
$_SESSION['sl_token']   = $token;

ok([
    'token' => $token,
    'user'  => ['id' => $userId, 'username' => $username, 'fullname' => $fullname, 'email' => $email, 'gender' => $gender, 'country' => $country],
]);
