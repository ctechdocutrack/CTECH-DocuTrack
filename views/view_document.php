
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

if (!isset($_GET['documents_id']) || !ctype_digit($_GET['documents_id'])) {
    exit('Invalid document ID.');
}

$documents_id = (int) ($_GET['documents_id'] ?? 0);

$documents = $_SESSION['cache']['documents'] ?? [];
$row = [];

while ($document = array_shift($documents)) {
    if ((int) $document['documents_id'] === $documents_id) {
        $row = $document;
        break;
    }
}

if (empty($row)) {
    exit('Document not found.');
}

$title = $row['title'] ?? '';
$description = $row['description'] ?? '';
$pdf_file = trim($row['pdf_file'] ?? '');
$camera_file = trim($row['camera_file'] ?? '');

$uploadUrl = '../uploads/documents/';

if ($pdf_file !== '') {
    $file = $uploadUrl . basename($pdf_file);
    $fileType = 'pdf';
} elseif ($camera_file !== '') {
    $file = $uploadUrl . basename($camera_file);
    $fileType = 'image';
} else {
    $file = '';
    $fileType = 'none';
}

?>

<div class="container-fluid bg-light min-vh-100">
    <div class="row">

        <?php include 'includes/sidebar.php'; ?>

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

                            <li class="breadcrumb-item">
                                <a href="documents.php"
                                   class="text-decoration-none">
                                    Documents
                                </a>
                            </li>

                            <li class="breadcrumb-item active"
                                aria-current="page">
                                View Document
                            </li>
                        </ol>
                    </nav>

                    <h2 class="fw-bold text-dark mb-1">
                        View Document
                    </h2>

                    <p class="text-secondary mb-0">
                        View your saved PDF or scanned image.
                    </p>
                </div>

                <a href="dashboard.php"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Documents
                </a>
            </div>

            <!-- Document Overview -->
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-file-earmark-text text-primary"></i>
                <h5 class="fw-bold mb-0">Document Overview</h5>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-semibold mb-1">
                        <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
                    </h5>

                    <small class="text-secondary">
                        Description: <?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>
                    </small>
                </div>

                <div class="card-body p-3 p-lg-4">

                    <?php if ($fileType === 'pdf'): ?>

                        <div class="d-flex align-items-center
                                    justify-content-between flex-wrap
                                    gap-2 mb-3">

                            <span class="badge text-bg-danger">
                                <i class="bi bi-file-pdf me-1"></i>
                                PDF Document
                            </span>

                            <a href="<?= htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?>"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                Open PDF
                            </a>
                        </div>

                    <?php elseif ($fileType === 'image'): ?>

                        <div class="d-flex align-items-center
                                    justify-content-between flex-wrap
                                    gap-2 mb-3">

                            
                            <span class="badge text-bg-success">
                                <i class="bi bi-image me-1"></i>
                                Scanned Image
                            </span>
                    

                        
                            <a href="<?= htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?>"
                            target="_blank"
                            rel="noopener"
                            class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                Open Image
                            </a>
                          

                        </div>

                    <?php else: ?>

                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            No PDF or camera image is saved for this document.
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
