<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTECH DocuTrack</title>
    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
</head>
<body>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/dbconn.php';
?>
    
