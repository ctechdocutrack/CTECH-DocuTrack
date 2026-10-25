<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$username = "31C8gLZVzWGYKem.root";
$password = "CHOXxHxYCB1jUfiW";
$dbname = "ctech_docutrack";
$port = 4000;

$caCert = __DIR__ . "/isrgrootx1.pem";

try {
    if (!is_readable($caCert)) {
        throw new RuntimeException(
            "TLS certificate not found: " . $caCert
        );
    }

    $conn = mysqli_init();

    mysqli_options($conn,MYSQLI_OPT_SSL_VERIFY_SERVER_CERT,true);
    mysqli_ssl_set($conn,null,null,$caCert,null,null);
    mysqli_report(MYSQLI_REPORT_OFF);

    $connected = @$conn->real_connect($host,$username,$password,$dbname,$port,null,MYSQLI_CLIENT_SSL);
    if (!$connected) {
        throw new RuntimeException("TiDB connection failed.");
    }
    $conn->set_charset("utf8mb4");

} catch (Throwable $e) {
    error_log("TiDB connection error: " . $e->getMessage());

    require __DIR__ . '/../assets/error_connection.php';

    exit;
}
?>
