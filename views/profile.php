<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';

$user_id = (int) $_SESSION['user_id'];

$users = $_SESSION['cache']['users'] ?? [];
$user = [];

while ($row = array_shift($users)) {
    if ((int) $row['user_id'] === $user_id) {
        $user = $row;
        break;
    }
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
                            <a href="dashboard.php"
                               class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active"
                            aria-current="page">My Profile</li>
                    </ol>
                </nav>

                <h2 class="fw-bold text-dark mb-1">My Profile</h2>
                <p class="text-secondary mb-0">
                    View and manage your account information.
                </p>
            </div>

            <!-- Account Alert -->
            <?php if (isset($_GET['account'])): ?>

                <?php if ($_GET['account'] === 'success'): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-3"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> Faculty account created successfully.
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php elseif ($_GET['account'] === 'exists'): ?>
                    <div class="alert alert-warning alert-dismissible fade show rounded-3"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Notice!</strong> The username or email may already exist,
                        or the account could not be created.
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php elseif ($_GET['account'] === 'error'): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3"
                        role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <strong>Error!</strong> Failed to create the faculty account.
                        Please try again.
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <!-- Profile Overview -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-sm-row
                                align-items-sm-center gap-3">

                        <div class="bg-primary bg-opacity-10
                                    text-primary rounded-circle
                                    d-flex align-items-center
                                    justify-content-center"
                             style="width: 90px; height: 90px; flex-shrink: 0;">
                            <i class="bi bi-person-fill"
                               style="font-size: 3rem;"></i>
                        </div>

                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-1">
                                <?= htmlspecialchars(
                                    $user['full_name'] ?? $user['username'] ?? 'User',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </h4>

                            <p class="text-secondary mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <?= htmlspecialchars(
                                    $user['email'] ?? 'No email provided',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </p>

                            <span class="badge bg-primary bg-opacity-10
                                         text-primary rounded-pill px-3 py-2">
                                <i class="bi bi-person-check me-1"></i>
                                <?= htmlspecialchars(
                                    $user['role'] ?? 'User',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </span>
                        </div>

                        
                        <div class="d-flex flex-wrap gap-2">

                            <button type="button"
                                    class="btn btn-primary rounded-3 px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square me-2"></i>
                                Edit Profile
                            </button>

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
            </div>

            <div class="row g-4">

                <!-- Profile Information -->
                <div class="col-12 col-xl-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-1">
                                <i class="bi bi-person-vcard text-primary me-2"></i>
                                Profile Information
                            </h5>
                            <p class="text-secondary small mb-0">
                                Your personal account details
                            </p>
                        </div>

                        <div class="card-body px-4 pt-0 pb-4">

                            <div class="mb-4">
                                <label class="text-secondary small mb-1">
                                    Full Name
                                </label>
                                <div class="fw-semibold text-dark">
                                    <?= htmlspecialchars(
                                        $user['full_name'] ?? 'Not provided',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="text-secondary small mb-1">
                                    Username
                                </label>
                                <div class="fw-semibold text-dark">
                                    <?= htmlspecialchars(
                                        $user['username'] ?? 'Not provided',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="text-secondary small mb-1">
                                    Email Address
                                </label>
                                <div class="fw-semibold text-dark">
                                    <?= htmlspecialchars(
                                        $user['email'] ?? 'Not provided',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>
                            </div>

                            <div>
                                <label class="text-secondary small mb-1">
                                    Account Role
                                </label>
                                <div class="fw-semibold text-dark">
                                    <?= htmlspecialchars(
                                        $user['role'] ?? 'Not specified',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="col-12 col-xl-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-1">
                                <i class="bi bi-shield-lock text-primary me-2"></i>
                                Account Details
                            </h5>
                            <p class="text-secondary small mb-0">
                                Account access and security
                            </p>
                        </div>

                        <div class="card-body px-4 pt-0 pb-4">

                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="bg-success bg-opacity-10
                                            text-success rounded-3 p-3">
                                    <i class="bi bi-check-circle fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Account Status</div>
                                    <div class="text-secondary small">
                                        Currently logged in
                                    </div>
                                </div>
                                <span class="badge bg-success ms-auto">
                                    Active
                                </span>
                            </div>

                            <hr class="text-secondary opacity-25">

                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="bg-primary bg-opacity-10
                                            text-primary rounded-3 p-3">
                                    <i class="bi bi-person-lock fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Login Security</div>
                                    <div class="text-secondary small">
                                        Your account requires authentication.
                                    </div>
                                </div>
                            </div>

                            <a href="../controller/logoutController.php"
                               class="btn btn-outline-danger rounded-3 w-100"
                               onclick="return confirm('Are you sure you want to log out?');">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Log Out
                            </a>

                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

<?php include 'modals/addFacultyModal.php'; ?>
<?php include 'modals/editProfileModal.php'; ?>
<script src="../assets/js/profile.js"></script>
<?php include 'includes/footer.php'; ?>
