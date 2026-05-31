<?php
/**
 * session_guard.php
 * Include this at the top of any page that requires login.
 * If user is not logged in, redirects to login.php
 */
if (session_status() === PHP_SESSION_NONE) session_start();

function requireLogin(string $redirect = 'login.php'): void {
    if (empty($_SESSION['sl_token']) || empty($_SESSION['sl_user_id'])) {
        header('Location: ' . $redirect);
        exit;
    }
    // Also validate token still exists in DB
    require_once __DIR__ . '/../config/db.php';
    $db = getDB();
    $st = $db->prepare('SELECT user_id FROM sessions WHERE token = ? AND expires_at > NOW()');
    $st->execute([$_SESSION['sl_token']]);
    if (!$st->fetch()) {
        // Session expired — destroy and redirect
        $_SESSION = [];
        session_destroy();
        header('Location: ' . $redirect);
        exit;
    }
}

function redirectIfLoggedIn(string $redirect = 'dashboard.php'): void {
    if (!empty($_SESSION['sl_token']) && !empty($_SESSION['sl_user_id'])) {
        header('Location: ' . $redirect);
        exit;
    }
}
