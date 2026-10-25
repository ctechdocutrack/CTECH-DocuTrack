
<?php
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $user_id LIMIT 1";
$sql_run = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($sql_run);

if (!$user) {
    header("Location: login.php");
    exit;
}

// Only admins can access the Users page
if (strtolower(trim($user['role'] ?? '')) !== 'admin') {
    header("Location: dashboard.php");
    exit;
}
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

                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-people text-primary me-2"></i>
                    Users
                </h2>

                <p class="text-secondary mb-0">
                    View all registered user accounts and their roles.
                </p>
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

                        <table class="table table-hover table-bordered
                                      align-middle mb-0"
                               id="usersTable">

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
                                $users_sql = "SELECT user_id, full_name,
                                                     username, email, role, status
                                              FROM users
                                              ORDER BY user_id DESC";

                                $users_run = mysqli_query($conn, $users_sql);

                                if ($users_run && mysqli_num_rows($users_run) > 0):

                                    while ($row = mysqli_fetch_assoc($users_run)):
                                        $role = strtolower($row['role'] ?? '');
                                        $status = strtolower($row['status'] ?? '');
                                ?>

                                    <tr>
                                        <td>
                                            <?= htmlspecialchars(
                                                $row['full_name'] ?? '',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['username'] ?? '',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['email'] ?? '',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?php if ($role === 'admin'): ?>
                                                <span class="badge bg-primary">
                                                    Admin
                                                </span>
                                            <?php elseif ($role === 'faculty'): ?>
                                                <span class="badge bg-success">
                                                    Faculty
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <?= htmlspecialchars(
                                                        $row['role'] ?? 'Unknown',
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($status === 'active'): ?>
                                                <span class="badge bg-success">
                                                    Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <?= htmlspecialchars(
                                                        $row['status'] ?? 'Unknown',
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                <?php
                                    endwhile;
                                else:
                                ?>
                                    <tr>
                                        <td colspan="5"
                                            class="text-center text-secondary py-4">
                                            <i class="bi bi-people fs-3 d-block mb-2"></i>
                                            No users found.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
