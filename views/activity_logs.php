
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cache']) || !is_array($_SESSION['cache'])) {
    $_SESSION = [];
    session_destroy();

    header("Location: login.php");
    exit;
}

include 'includes/header.php';

$user_id = (int) $_SESSION['user_id'];

$users = $_SESSION['cache']['users'] ?? [];
$user = [];

foreach ($users as $row) {
    if ((int) $row['user_id'] === $user_id) {
        $user = $row;
        break;
    }
}

// Activity logs from session cache
$activity_logs = $_SESSION['cache']['activity_logs'] ?? [];
?>

<div class="container-fluid bg-light min-vh-100">
    <div class="row min-vh-100">

        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="col-12 col-md-9 col-lg-10 p-3 p-lg-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row
                        justify-content-between align-items-sm-center
                        gap-3 mb-4">

                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb small mb-2">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php"
                                   class="text-decoration-none">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">
                                Activity Logs
                            </li>
                        </ol>
                    </nav>

                    <h2 class="fw-bold text-dark mb-1">
                        Activity Logs
                    </h2>

                    <p class="text-secondary mb-0">
                        Monitor user activities and system actions.
                    </p>
                </div>

            </div>

            <!-- Activity Logs Table -->
            <div class="card border-0 shadow-sm rounded-4">

                <!-- Table Header -->
                <div class="card-header bg-white border-0 p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary bg-opacity-10
                                    text-primary rounded-3 p-2">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                System Activity History
                            </h5>
                            <p class="text-secondary small mb-0">
                                Records of user actions and their status.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Table Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered
                                      align-middle mb-0"
                               id="activityLogsTable">

                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">User ID</th>
                                    <th class="py-3">Username</th>
                                    <th class="py-3">Action</th>
                                    <th class="py-3">Description</th>
                                    <th class="py-3 text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (!empty($activity_logs)) {
                                    while ($row = array_shift($activity_logs)) {
                                        $log_user_id = ($row['user_id'] ?? '');
                                        $username = ($row['username'] ?? '');
                                        $action = ($row['action'] ?? '');
                                        $description = ($row['description'] ?? '');
                                        $status = ($row['status'] ?? '');

                                        $status_lower = strtolower($status);

                                        if ($status_lower === 'success') {
                                            $status_badge = "<span class='badge bg-success'>Success</span>";
                                        } elseif ($status_lower === 'failed') {
                                            $status_badge = "<span class='badge bg-danger'>Failed</span>";
                                        } elseif ($status_lower === 'pending') {
                                            $status_badge = "<span class='badge bg-warning text-dark'>Pending</span>";
                                        } else {
                                            $status_badge = "<span class='badge bg-secondary'>$status</span>";
                                        }

                                        echo "
                                        <tr>
                                            <td>$log_user_id</td>
                                            <td>
                                                <div class='fw-semibold'>
                                                    $username
                                                </div>
                                            </td>
                                            <td>$action</td>
                                            <td>
                                                <div style='overflow-wrap: anywhere;'>
                                                    $description
                                                </div>
                                            </td>
                                            <td class='text-center'>
                                                $status_badge
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "
                                    <tr>
                                        <td colspan='6'
                                            class='text-center text-secondary py-5'>
                                            <i class='bi bi-clock-history fs-3 d-block mb-2'></i>
                                            No activity logs found.
                                        </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

<?php include 'includes/jquery_scripts.php'; ?>
<script src="../assets/js/activity_logs.js"></script>

<?php include 'includes/footer.php'; ?>
