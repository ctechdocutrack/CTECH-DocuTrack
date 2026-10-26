<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../config/dbconn.php';
require_once __DIR__ . '/activityLogsController.php';

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username'] ?? ''));
    $password = mysqli_real_escape_string($conn, trim($_POST['password'] ?? ''));

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = 'Please enter both username and password.';
        header("Location: ../views/login.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['cache'] = [];

            $sql = "SHOW TABLES";
            $tables_result = mysqli_query($conn, $sql);

            if ($tables_result) {
                while ($row = mysqli_fetch_row($tables_result)) {
                    $tableName = $row[0];
                    
                    $sql_table = "SELECT * FROM $tableName";
                    $data_result = mysqli_query($conn, $sql_table);

                    if ($data_result) {
                        $rows = [];
                        while ($row = mysqli_fetch_assoc($data_result)) {
                            if ($tableName === 'users') {
                                unset($row['password']);
                            }
                            $rows[] = $row;
                        }
                        $_SESSION['cache'][$tableName] = $rows;
                        mysqli_free_result($data_result);
                    } else {
                        error_log("Cache error for table $tableName: " . mysqli_error($conn));
                    }
                }
                mysqli_free_result($tables_result);
            }
            $_SESSION['cache_loaded_at'] = time();
            logActivity(
                $_SESSION['user_id'],
                $user['username'],
                'Login',
                'Account logged in successfully.',
                'Success'
            );
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            $_SESSION['login_error'] = 'Invalid username or password.';
            header("Location: ../views/login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = 'Invalid username or password.';
        header("Location: ../views/login.php");
        exit;
    }
} else {
    header("Location: ../views/login.php");
    exit;

}
?>