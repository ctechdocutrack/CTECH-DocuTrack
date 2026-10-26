<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/dbconn.php';

function logActivity($user_id, $username, $action, $description, $status = 'Success')
{
    global $conn;

    $user_id = (int) $user_id;
    $username = mysqli_real_escape_string($conn, $username);
    $action = mysqli_real_escape_string($conn, $action);
    $description = mysqli_real_escape_string($conn, $description);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "INSERT INTO activity_logs (user_id, username, action, description, status)
            VALUES ($user_id, '$username', '$action', '$description', '$status')";
    $sql_run = mysqli_query($conn, $sql);

    if (!$sql_run) {
        error_log('Activity log error: ' . mysqli_error($conn));
        return false;
    }   

    // Refresh cached activity logs after a successful insert.
    $logs_result = mysqli_query($conn,"SELECT * FROM activity_logsORDER BY log_id DESC LIMIT 100");
    if ($logs_result) {
        $_SESSION['cache']['activity_logs'] = [];
        while ($row = mysqli_fetch_assoc($logs_result)) {
            $_SESSION['cache']['activity_logs'][] = $row;
        }
        mysqli_free_result($logs_result);
    }
    return true;
}
?>
