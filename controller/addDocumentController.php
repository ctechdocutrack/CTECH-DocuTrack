
<?php
include_once '../config/dbconn.php';

if (isset($_POST['add_document'])) {
    $title       = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
    $description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
    $category    = mysqli_real_escape_string($conn, trim($_POST['category'] ?? ''));
    $type        = mysqli_real_escape_string($conn, trim($_POST['type'] ?? ''));

    // if ($title === '' || $category === '' || $type === '') {
    //     die('Please complete all required fields.');
    // }
    $uploadDir = '../uploads/documents/';

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        die('Unable to create upload directory.');
    }

    $pdf_file = null;
    $camera_file = null;
    $savedFilePath = null;

    $pdfSelected = isset($_FILES['pdf_file'])
        && $_FILES['pdf_file']['error'] !== UPLOAD_ERR_NO_FILE;

    $cameraSelected = isset($_FILES['camera_file'])
        && $_FILES['camera_file']['error'] !== UPLOAD_ERR_NO_FILE;

    // Require exactly one attachment
    if ($pdfSelected && $cameraSelected) {
        die('Please choose either a PDF or a camera image, not both.');
    }

    if (!$pdfSelected && !$cameraSelected) {
        die('Please upload a PDF or capture a document photo.');
    }

    // PDF upload
    if ($pdfSelected) {
        if ($_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
            die('The PDF upload failed.');
        }
        $tmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $mimeType = mime_content_type($tmpPath);
        if ($fileSize > 10 * 1024 * 1024) {
            die('PDF file must not exceed 10 MB.');
        }
        if ($mimeType !== 'application/pdf') {
            die('Only valid PDF files are allowed.');
        }
    }

    // Camera image upload
    if ($cameraSelected) {
        if ($_FILES['camera_file']['error'] !== UPLOAD_ERR_OK) {
            die('The camera image upload failed.');
        }
        $tmpPath = $_FILES['camera_file']['tmp_name'];
        $fileSize = $_FILES['camera_file']['size'];
        $imageInfo = getimagesize($tmpPath);
        if ($fileSize > 10 * 1024 * 1024) {
            die('Image file must not exceed 10 MB.');
        }
        if (
            $imageInfo === false ||
            $imageInfo['mime'] !== 'image/jpeg'
        ) {
            die('Please upload a valid JPEG camera image.');
        }
    }

    // Step 1: Insert document first to generate documents_id
    $sql = "INSERT INTO documents (title, description, category, type, pdf_file, camera_file)
            VALUES ('$title', '$description', '$category', '$type', NULL, NULL)";

    if (!mysqli_query($conn, $sql)) {
        die('Database error: ' . mysqli_error($conn));
    }

    // Step 2: Get generated documents_id
    $documents_id = mysqli_insert_id($conn);

    // Step 3: Generate filename using title + documents_id
    $fileTitle = preg_replace(
        '/[^a-zA-Z0-9_-]/',
        '_',
        trim($_POST['title'] ?? '')
    );

    if ($fileTitle === '') {
        $fileTitle = 'Document';
    }

    $pdf_file = null;
    $camera_file = null;
    $savedFilePath = null;

    // Step 4: Save the selected file
    if ($pdfSelected) {
        $pdf_file = $fileTitle . '_' . $documents_id . '.pdf';
        $savedFilePath = $uploadDir . $pdf_file;

        if (!move_uploaded_file(
            $_FILES['pdf_file']['tmp_name'],
            $savedFilePath
        )) {
            mysqli_query($conn,"DELETE FROM documents WHERE documents_id = $documents_id");
            die('Unable to save the PDF file.');
        }
    }

    if ($cameraSelected) {
        $camera_file = $fileTitle . '_' . $documents_id . '.jpeg';
        $savedFilePath = $uploadDir . $camera_file;

        if (!move_uploaded_file(
            $_FILES['camera_file']['tmp_name'],
            $savedFilePath
        )) {
            mysqli_query($conn,"DELETE FROM documents WHERE documents_id = $documents_id");
            die('Unable to save the camera image.');
        }
    }

    // Step 5: Update filenames in database
    $pdfValue = $pdf_file !== null
        ? "'" . mysqli_real_escape_string($conn, $pdf_file) . "'"
        : "NULL";

    $cameraValue = $camera_file !== null
        ? "'" . mysqli_real_escape_string($conn, $camera_file) . "'"
        : "NULL";

    $updateSql = "UPDATE documents 
                  SET pdf_file = $pdfValue, camera_file = $cameraValue
                  WHERE documents_id = $documents_id";
    if (mysqli_query($conn, $updateSql)) {
        header("Location: ../views/dashboard.php");
        exit;
    } else {
        if ($savedFilePath && file_exists($savedFilePath)) {
            unlink($savedFilePath);
        }
        mysqli_query($conn,"DELETE FROM documents WHERE documents_id = $documents_id");
        die('Database update error: ' . mysqli_error($conn));
    }
}
?>
