<?php
$current_page = basename($_SERVER['PHP_SELF']);

function navActive($page, $current_page) {
    return $page === $current_page
        ? 'active bg-primary text-white'
        : 'text-white-50';
}
?>


<!-- Mobile Top Navbar -->
<nav class="navbar bg-white border-bottom px-3 py-3 d-md-none">
    <div class="d-flex align-items-center gap-2">
        <div class="rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0">
            <img src="../assets/images/CTech Logo.png"
                 alt="CTECH Logo"
                 style="width: 45px; height: 45px; object-fit: contain;">
        </div>

        <div>
            <div class="fw-bold text-dark">CTECH</div>
            <div class="text-secondary small">DocuTrack</div>
        </div>
    </div>

    <button class="btn btn-light border rounded-3"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileSidebar"
            aria-controls="mobileSidebar"
            aria-label="Open navigation">
        <i class="bi bi-list fs-4"></i>
    </button>
</nav>


<!-- Desktop Sidebar -->
<aside class="d-none d-md-flex flex-column col-md-3 col-lg-2 bg-dark text-white vh-100 p-3 overflow-hidden sticky-top" style="top: 0;">
    <!-- Brand -->
    <a href="dashboard.php"
    class="text-decoration-none text-white d-flex align-items-center gap-3 p-2 mb-4">
        <div class="rounded-3 p-2 flex-shrink-0">
            <img src="../assets/images/CTech Logo.png"
                class="img-fluid"
                style="width: 45px; height: 45px; object-fit: contain;"
                alt="CTECH Logo">
        </div>

        <div>
            <h5 class="fw-bold mb-0">CTECH</h5>
            <small class="text-white-50">DocuTrack System</small>
        </div>
    </a>
    <!-- Section Label -->
    <div class="text-uppercase text-white-50 small fw-semibold px-3 mb-2">
        Main Menu
    </div>
    <!-- Navigation -->
    <nav class="nav flex-column gap-2">
        <a href="dashboard.php"
        class="nav-link <?= navActive('dashboard.php', $current_page) ?> rounded-3 px-3 py-3">
            <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
        </a>
        <a href="documents.php"
        class="nav-link <?= navActive('documents.php', $current_page) ?> rounded-3 px-3 py-3">
            <i class="bi bi-folder2-open me-3"></i> Documents
        </a>
        <?php if (strtolower(trim($user['role'] ?? '')) === 'admin'): ?>
            <a href="users.php"
            class="nav-link <?= navActive('users.php', $current_page) ?> rounded-3 px-3 py-3">
                <i class="bi bi-person me-3"></i> Users
            </a>

            <a href="activity_logs.php"
            class="nav-link <?= navActive('activity_logs.php', $current_page) ?> rounded-3 px-3 py-3">
                <i class="bi bi-clock-history me-3"></i> Activity Log
            </a>
        <?php endif; ?>
    </nav>
    <!-- Bottom Profile -->
    <div class="mt-auto pt-4">
        <hr class="border-secondary">
        <div class="d-flex align-items-center gap-3 p-2">
            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn bg-primary text-white rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 42px; height: 42px;" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile options">
                    <i class="bi bi-person-fill fs-5"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-dark bg-dark dropdown-menu-end shadow border border-secondary rounded-3 p-2 mb-4">
                    <li>
                        <h6 class="dropdown-header text-uppercase small text-white">Account Settings</h6>
                    </li>
                    <li>
                        <a class="dropdown-item text-white rounded-2 py-2" href="profile.php">
                            <i class="bi bi-person-gear me-2"></i> Edit Profile
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <div class="fw-semibold text-white text-truncate">
                    <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <small class="text-white-50 text-uppercase">
                    <?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?>
                </small>
            </div>
            <a href="../controller/logoutController.php" class="text-white-50" title="Logout" aria-label="Logout">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </a>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom border-secondary py-4">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-3 p-2">
                <img src="../assets/images/CTech Logo.png"
                class="img-fluid"
                style="width: 50px; height: 50px; object-fit: contain;"
                alt="CTECH Logo">
            </div>
            <div>
                <h5 class="fw-bold mb-0" id="mobileSidebarLabel">CTECH</h5>
                <small class="text-white-50">DocuTrack System</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-3">
        <div class="text-uppercase text-white-50 small fw-semibold px-3 mb-3"> Main Menu</div>
        <nav class="nav flex-column gap-2">
            <a href="dashboard.php"
            class="nav-link <?= navActive('dashboard.php', $current_page) ?> rounded-3 px-3 py-3">
                <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
            </a>
            <a href="documents.php"
            class="nav-link <?= navActive('documents.php', $current_page) ?> rounded-3 px-3 py-3">
                <i class="bi bi-folder2-open me-3"></i> Documents
            </a>
            <?php if (strtolower(trim($user['role'] ?? '')) === 'admin'): ?>
                <a href="users.php"
                class="nav-link <?= navActive('users.php', $current_page) ?> rounded-3 px-3 py-3">
                    <i class="bi bi-person me-3"></i> Users
                </a>

                <a href="activity_logs.php"
                class="nav-link <?= navActive('activity_logs.php', $current_page) ?> rounded-3 px-3 py-3">
                    <i class="bi bi-clock-history me-3"></i> Activity Log
                </a>
            <?php endif; ?>
        </nav>
        <div class="mt-auto pt-4">
            <hr class="border-secondary">
                <div class="d-flex align-items-center gap-3 p-2">
                    <div class="dropdown">
                    <button class="btn bg-primary text-white rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 42px; height: 42px;" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile options">
                        <i class="bi bi-person-fill fs-5"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-dark bg-dark dropdown-menu-end shadow border border-secondary rounded-3 p-2 mb-4">
                        <li>
                            <h6 class="dropdown-header text-uppercase small text-white">Account Settings</h6>
                        </li>
                        <li>
                            <a class="dropdown-item text-white rounded-2 py-2" href="profile.php">
                                <i class="bi bi-person-gear me-2"></i> Edit Profile
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold text-uppercase">
                        <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <small class="text-white-50">
                        <?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?>
                    </small>
                </div>
                <a href="../controller/logoutController.php" class="text-white-50" aria-label="Logout">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </a>
            </div>
        </div>
    </div>
</div>
