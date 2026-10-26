<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/activityLogsController.php';

// Record logout before destroying the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'] ?? 'Unknown';

    logActivity(
        $user_id,
        $username,
        'Logout',
        'User logged out successfully.',
        'Success'
    );
}

$_SESSION = [];

session_destroy();

header("Location: ../views/login.php");
exit;