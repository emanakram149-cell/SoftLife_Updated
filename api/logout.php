<?php
require_once __DIR__ . '/../includes/helpers.php';
setHeaders();

// ── DESTROY PHP SESSION ──
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}
session_destroy();

// ── ALSO DESTROY DB TOKEN ──
$token = $_SERVER['HTTP_X_TOKEN'] ?? '';
if ($token && strlen($token) === 64) {
    getDB()->prepare('DELETE FROM sessions WHERE token = ?')->execute([$token]);
}

ok(['message' => 'Logged out successfully.']);
