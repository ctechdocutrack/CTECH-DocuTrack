
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

$categories = [];
$documents = $_SESSION['cache']['documents'] ?? [];

$documentIndex = 0;
$totalDocuments = count($documents);

while ($documentIndex < $totalDocuments) {
    $document = $documents[$documentIndex];
    $category = trim($document['category'] ?? '');

    if ($category !== '' && !in_array($category, $categories, true)) {
        $categories[] = $category;
    }
    $documentIndex++;
}

// Sort categories alphabetically
sort($categories, SORT_STRING);

// Get selected category from URL
$selectedCategory = trim($_GET['category'] ?? '');

// Only allow categories that exist in the cache
if ($selectedCategory !== '' && !in_array($selectedCategory, $categories, true)) {
    $selectedCategory = '';
}

// Get documents for selected category from cache
$filteredDocuments = [];

if ($selectedCategory !== '') {
    $documentIndex = 0;
    $totalDocuments = count($documents);

    while ($documentIndex < $totalDocuments) {
        $document = $documents[$documentIndex];

        if (trim($document['category'] ?? '') === $selectedCategory) {
            $filteredDocuments[] = $document;
        }

        $documentIndex++;
    }
}

// Use this to loop through the filtered documents
$documents = $filteredDocuments;
?>

<div class="container-fluid bg-light min-vh-100">
    <div class="row min-vh-100">

        <?php include 'includes/sidebar.php'; ?>

        <main class="col-12 col-md-9 col-lg-10 p-3 p-lg-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row
                        justify-content-between align-items-sm-center
                        gap-3 mb-4">

                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb small mb-2">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php" class="text-decoration-none">
                                    Home
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="documents.php" class="text-decoration-none">
                                    Documents
                                </a>
                            </li>

                            <?php if ($selectedCategory !== ''): ?>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= htmlspecialchars($selectedCategory) ?>
                                </li>
                            <?php endif; ?>
                        </ol>
                    </nav>

                    <h2 class="fw-bold text-dark mb-1">Documents</h2>

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

            <?php if ($selectedCategory === ''): ?>

                <!-- Categories from Database -->
                <div class="row g-3 mt-2">

                    <?php if (!empty($categories)): ?>

                        <?php foreach ($categories as $category): ?>
                            <div class="col-12 col-sm-6 col-xl-4">
                                <a href="documents.php?category=<?= urlencode($category) ?>"
                                   class="text-decoration-none">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center gap-3">

                                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                                    <i class="bi bi-folder-fill fs-2"></i>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h6 class="fw-bold text-dark mb-1">
                                                        <?= htmlspecialchars($category) ?>
                                                    </h6>

                                                    <small class="text-secondary">
                                                        View documents
                                                    </small>
                                                </div>

                                                <i class="bi bi-chevron-right text-secondary"></i>

                                            </div>
                                        </div>
                                    </div>

                                </a>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-folder2-open fs-1 text-secondary"></i>

                                    <h5 class="fw-bold mt-3">No Categories Yet</h5>

                                    <p class="text-secondary mb-0">
                                        Categories will appear here once documents are added.
                                    </p>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            <?php else: ?>

                <!-- Back to Folders -->
                <div class="mb-3">
                    <a href="documents.php"
                       class="btn btn-outline-secondary rounded-3">
                        <i class="bi bi-arrow-left me-2"></i>
                        Back to Folders
                    </a>
                </div>

                <!-- Selected Category Header -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                <i class="bi bi-folder-fill fs-2"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">
                                    <?= htmlspecialchars($selectedCategory) ?>
                                </h4>

                                <p class="text-secondary mb-0">
                                    Documents stored in this category
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Documents Table -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 p-lg-4">

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">

                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20%;">Title</th>
                                        <th style="width: 30%;">Description</th>
                                        <th style="width: 15%;">Year</th>
                                        <th style="width: 15%;">Type</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($documents)): ?>
                                        <?php while ($document = array_shift($documents)): ?>
                                            <tr>
                                                <td class="fw-semibold">
                                                    <?= htmlspecialchars($document['title'] ?? '') ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($document['description'] ?? '') ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars((string)($document['year'] ?? '')) ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $type = $document['type'] ?? '';
                                                    $badgeClass = $type === 'Incoming'
                                                        ? 'text-bg-success'
                                                        : 'text-bg-primary';
                                                    ?>
                                                    <span class="badge <?= $badgeClass ?>">
                                                        <?= htmlspecialchars($type) ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="view_document.php?documents_id=<?= (int)$document['documents_id'] ?>"
                                                       class="btn btn-sm btn-outline-primary rounded-3">
                                                        <i class="bi bi-eye me-1"></i>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="bi bi-folder2-open fs-1 text-secondary"></i>
                                                <p class="fw-semibold mt-2 mb-1">
                                                    No documents found
                                                </p>
                                                <p class="text-secondary small mb-0">
                                                    There are no documents in this category yet.
                                                </p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<!-- Add Document Modal -->
<?php include 'modals/addDocumentModal.php'; ?>
<?php include 'includes/footer.php'; ?>
