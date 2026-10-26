<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

include 'includes/header.php';
?>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center p-3">
    <div class="row bg-white rounded-4 shadow-sm overflow-hidden w-100"
         style="max-width: 950px; min-height: 540px;">
        <!-- Left Panel -->
        <div class="col-md-6 bg-primary text-white d-flex flex-column justify-content-center align-items-center text-center p-5">
            <div class="rounded-4 p-4 mb-2">
                <img src="../assets/images/CTech Logo.png" alt="">
            </div>
            <h2 class="fw-bold mb-1">CTECH DocuTrack</h2>
            <p class="text-white-50 mb-4 fw-semibold">College of Technology</p>
            <div class="border-top border-white border-opacity-25 pt-4">
                <p class="small text-white-50 mb-0">
                    Organize, access, and manage your documents in one place.
                </p>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="col-md-6 d-flex align-items-center p-4 p-lg-5">
            <div class="w-100">
                <div class="mb-4">
                    <span class="text-primary small fw-semibold">WELCOME BACK</span>
                    <h3 class="fw-bold text-dark mt-2 mb-2">Sign in to your account</h3>
                    <p class="text-secondary mb-0">
                        Enter your credentials to continue.
                    </p>
                </div>
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        <?= htmlspecialchars($_SESSION['login_error'], ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['login_error']); ?>
                <?php endif; ?>
                <form action="../controller/loginController.php" method="POST">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-person text-secondary"></i>
                            </span>
                            <input type="text" class="form-control bg-light border-start-0 py-2" id="username" name="username" placeholder="Enter your username" autocomplete="username" required>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-lock text-secondary"></i>
                            </span>
                            <input type="password" class="form-control bg-light border-start-0 border-end-0 py-2" id="password" name="password" placeholder="Enter your password"autocomplete="current-password" required>
                            <button class="btn btn-light border border-start-0" type="button" id="togglePassword" aria-label="Show password">
                                <i class="bi bi-eye text-secondary" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Login Button -->
                    <button type="submit" name="login"class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                    </button>
                </form>

                <div class="text-center mt-4">
                    <small class="text-secondary">
                        <i class="bi bi-shield-lock me-1"></i> Authorized personnel only
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/login.js"></script>

<?php include 'includes/footer.php'; ?>
