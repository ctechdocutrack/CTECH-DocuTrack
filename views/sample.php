<?php
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cache = $_SESSION['cache'] ?? [];
?>



<div class="container-fluid py-4">

    <h3 class="fw-bold mb-4">Session Cache Viewer</h3>

    <?php if (empty($cache)): ?>

        <div class="alert alert-warning">
            Walang data sa session cache. Mag-log out at mag-login ulit.
        </div>

    <?php else: ?>

        <div class="alert alert-success">
            Cache loaded successfully!
            <br>
            Total tables cached: <?= count($cache) ?>
        </div>

        <?php foreach ($cache as $tableName => $rows): ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <?= htmlspecialchars($tableName) ?>
                        <span class="badge bg-primary">
                            <?= count($rows) ?> records
                        </span>
                    </h5>
                </div>

                <div class="card-body">

                    <?php if (empty($rows)): ?>

                        <p class="text-secondary mb-0">
                            No records found in this table.
                        </p>

                    <?php else: ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <?php foreach (array_keys($rows[0]) as $column): ?>
                                            <th>
                                                <?= htmlspecialchars($column) ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <?php foreach ($row as $value): ?>
                                                <td>
                                                    <?= htmlspecialchars(
                                                        (string) ($value ?? ''),
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>
