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

        <!-- Main Content -->
        <main class="col-12 col-md-9 col-lg-10 p-3 p-lg-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row
                        justify-content-between align-items-sm-center
                        gap-3 mb-3">

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
                                Dashboard
                            </li>
                        </ol>
                    </nav>

                    <h2 class="fw-bold text-dark mb-1">
                        Dashboard
                    </h2>

                    <p class="text-secondary mb-0">
                        Welcome back! Here's your document overview.
                    </p>
                </div>

                <?php if ($user['role'] === 'admin'): ?>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button"
                            class="btn btn-primary rounded-3 px-3 py-2"
                            data-bs-toggle="modal"
                            data-bs-target="#addDocumentModal">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Document
                    </button>
                </div>
                <?php endif; ?>

            </div>

            <!-- Overview Label -->
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-grid-1x2-fill text-primary"></i>
                <h5 class="fw-bold mb-0">Document Overview</h5>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-3 mb-3">

                <!-- Total Documents -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-3">

                            <div class="d-flex justify-content-between
                                        align-items-start mb-3">

                                <div>
                                    <p class="text-secondary small mb-2">
                                        Total Documents
                                    </p>
                                    <h2 class="fw-bold text-dark mb-0">
                                        1,250
                                    </h2>
                                </div>

                                <div class="bg-primary bg-opacity-10
                                            text-primary rounded-3 p-3">
                                    <i class="bi bi-files fs-4"></i>
                                </div>
                            </div>

                            <div class="text-secondary small">
                                <i class="bi bi-archive me-1"></i>
                                Digital document repository
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Incoming Documents -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-3">

                            <div class="d-flex justify-content-between
                                        align-items-start mb-3">

                                <div>
                                    <p class="text-secondary small mb-2">
                                        Incoming Documents
                                    </p>
                                    <h2 class="fw-bold text-dark mb-0">
                                        24
                                    </h2>
                                </div>

                                <div class="bg-info bg-opacity-10
                                            text-info rounded-3 p-3">
                                    <i class="bi bi-inbox fs-4"></i>
                                </div>
                            </div>

                            <div class="text-secondary small">
                                <i class="bi bi-arrow-down-left me-1"></i>
                                Received files
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Pending Documents -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-3">

                            <div class="d-flex justify-content-between
                                        align-items-start mb-3">

                                <div>
                                    <p class="text-secondary small mb-2">
                                        Pending Documents
                                    </p>
                                    <h2 class="fw-bold text-dark mb-0">
                                        18
                                    </h2>
                                </div>

                                <div class="bg-warning bg-opacity-10
                                            text-warning rounded-3 p-3">
                                    <i class="bi bi-clock-history fs-4"></i>
                                </div>
                            </div>

                            <div class="text-secondary small">
                                <i class="bi bi-hourglass-split me-1"></i>
                                Awaiting action
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Archived Documents -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-3">

                            <div class="d-flex justify-content-between
                                        align-items-start mb-3">

                                <div>
                                    <p class="text-secondary small mb-2">
                                        Archived Documents
                                    </p>
                                    <h2 class="fw-bold text-dark mb-0">
                                        860
                                    </h2>
                                </div>

                                <div class="bg-success bg-opacity-10
                                            text-success rounded-3 p-3">
                                    <i class="bi bi-check2-circle fs-4"></i>
                                </div>
                            </div>

                            <div class="text-secondary small">
                                <i class="bi bi-shield-check me-1"></i>
                                Stored in the archive
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent Documents -->
            <div class="card border-0 shadow-sm rounded-4">

                <!-- Table Header -->
                <div class="card-header bg-white border-0 p-3 p-lg-3">

                    <div class="d-flex flex-column flex-lg-row
                                justify-content-between align-items-lg-center
                                gap-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                <i class="bi bi-file-earmark-text
                                          text-primary me-2"></i>
                                Recent Documents
                            </h5>

                            <p class="text-secondary small mb-0">
                                Overview of recently registered documents
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Table Body -->
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0"
                               id="recentDocumentsTable">

                            <thead class="table-light">
                                <tr class="">
                                    <th class="py-3" style="width: 22%;">Document Title</th>
                                    <th class="py-3" style="width: 30%;">Description</th>
                                    <th class="py-3" style="width: 16%;">Category</th>
                                    <th class="py-3" style="width: 10%;">Year</th>
                                    <th class="py-3" style="width: 14%;">Type</th>
                                    <th class="text-center py-3" style="width: 18%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                            $documents = $_SESSION['cache']['documents'] ?? [];

                            while ($row = array_shift($documents)) {
                                $documents_id = htmlspecialchars($row['documents_id'], ENT_QUOTES, 'UTF-8');
                                $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
                                $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8');
                                $year = htmlspecialchars($row['year'], ENT_QUOTES, 'UTF-8');
                                $type = htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8');

                                echo "
                                <tr>
                                    <td>
                                        <div class='d-flex align-items-center gap-3'>
                                            <div class='bg-primary bg-opacity-10
                                                        text-primary rounded-3 p-2'>
                                                <i class='bi bi-file-earmark-text fs-4'></i>
                                            </div>
                                            <div>
                                                <div class='fw-semibold'>
                                                    $title
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style=' display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; overflow-wrap: anywhere; line-height: 1.5;
                                        ' title='$description'>
                                            $description
                                        </div>
                                    </td>
                                    <td>
                                        $category
                                    </td>
                                    <td>
                                        $year
                                    </td>
                                    <td>
                                        $type
                                    </td>
                                    <td class='text-center'>
                                        <a href='view_document.php?documents_id=$documents_id'
                                        class='btn btn-outline-primary btn-sm'>
                                            <i class='bi bi-eye me-1'></i>
                                        </a>
                                    </td>
                                </tr>";

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty Search Message -->
                    <div id="noDocumentsFound"
                         class="d-none text-center py-5">

                        <i class="bi bi-search display-5 text-secondary"></i>

                        <h6 class="fw-bold mt-3">
                            No documents found
                        </h6>

                        <p class="text-secondary small mb-0">
                            Try searching with another keyword.
                        </p>

                    </div>

                </div>
            </div>

        </main>
    </div>
</div>

<!-- Add Document Modal -->
<?php include 'modals/addDocumentModal.php'; ?>
<?php include 'includes/jquery_scripts.php'; ?>
<script src="../assets/js/dashboard.js"></script>
<?php include 'includes/footer.php'; ?>
