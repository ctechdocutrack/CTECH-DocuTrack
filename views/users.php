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

// $sql = "SELECT * FROM users WHERE user_id = $user_id LIMIT 1";
// $sql_run = mysqli_query($conn, $sql);
// $user = mysqli_fetch_assoc($sql_run);

// if (!$user) {
//     header("Location: login.php");
//     exit;
// }

$user_id = (int) $_SESSION['user_id'];

$users = $_SESSION['cache']['users'] ?? [];
$user = [];

while ($row = array_shift($users)) {
    if ((int) $row['user_id'] === $user_id) {
        $user = $row;
        break;
    }
}

// Only admins can access the Users page
// if (strtolower(trim($user['role'] ?? '')) !== 'admin') {
//     header("Location: dashboard.php");
//     exit;
// }
?>

<div class="container-fluid bg-light min-vh-100">
    <div class="row min-vh-100">

        <?php include 'includes/sidebar.php'; ?>

        <main class="col-12 col-md-9 col-lg-10 p-3 p-lg-4">

            <!-- Page Header -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-2">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php" class="text-decoration-none">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active"
                            aria-current="page">
                            Users
                        </li>
                    </ol>
                </nav>

                
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h2 class="fw-bold text-dark mb-1">
                                Users
                            </h2>

                            <p class="text-secondary mb-0">
                                View all registered user accounts and their roles.
                            </p>
                        </div>

                        <?php if (strtolower(trim($user['role'] ?? '')) === 'admin'): ?>
                            <button type="button"
                                    class="btn btn-success rounded-3 px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addFacultyModal">
                                <i class="bi bi-person-plus me-2"></i>
                                Add User Account
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                
            </div>

            <!-- All Users Table -->
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 p-3">
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i>
                        All Users
                    </h5>

                    <p class="text-secondary small mb-0">
                        List of all registered system accounts
                    </p>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle mb-0" id="usersTable">

                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">Full Name</th>
                                    <th class="py-3">Username</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3">Role</th>
                                    <th class="py-3">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $users = $_SESSION['cache']['users'] ?? [];

                                while ($row = array_shift($users)) {
                                    $user_id = htmlspecialchars($row['user_id']);
                                    $full_name = htmlspecialchars($row['full_name']);
                                    $username = htmlspecialchars($row['username']);
                                    $email = htmlspecialchars($row['email']);
                                    $role = htmlspecialchars($row['role']);
                                    $status = htmlspecialchars($row['status']);

                                    if ($role === 'admin') {
                                        $role_badge = "<span class='badge bg-primary'>Admin</span>";
                                    } elseif ($role === 'faculty') {
                                        $role_badge = "<span class='badge bg-success'>Faculty</span>";
                                    } else {
                                        $role_badge = "<span class='badge bg-secondary'>$role</span>";
                                    }

                                    echo "
                                    <tr>
                                        <td>
                                            <div class='fw-semibold'>$full_name</div>
                                        </td>
                                        <td>
                                            <div class='fw-semibold'>$username</div>
                                        </td>
                                        <td>$email</td>
                                        <td class='text-center'>$role_badge</td>
                                        <td>$status</td>
                                    </tr>";
                                }
                                if (empty($_SESSION['cache']['users'])) {
                                    echo "
                                    <tr>
                                        <td colspan='5' class='text-center text-secondary py-4'>
                                            <i class='bi bi-people fs-3 d-block mb-2'></i>
                                            No users found.
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

<?php include 'modals/addFacultyModal.php'; ?>
<?php include 'includes/jquery_scripts.php'; ?>
<script src="../assets/js/users.js"></script>
<?php include 'includes/footer.php'; ?>
