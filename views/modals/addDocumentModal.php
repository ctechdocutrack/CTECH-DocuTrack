<div class="modal fade" id="addDocumentModal" tabindex="-1"
     aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white border-0 p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-25 rounded-3 p-3">
                        <i class="bi bi-file-earmark-plus fs-3"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1"
                            id="addDocumentModalLabel">
                            Add New Document
                        </h5>
                        <p class="mb-0 small text-white-50">
                            Enter the details of the document below.
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white"data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="../controller/addDocumentController.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="alert alert-light border d-flex align-items-start gap-3 mb-4">
                        <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                        <div>
                            <div class="fw-semibold">Document Information</div>
                            <small class="text-secondary">
                                Please provide accurate information for proper document tracking.
                            </small>
                        </div>
                    </div>
                    <div class="row g-3">
                        <!-- Document Title -->
                        <div class="col-12">
                            <label for="documentTitle" class="form-label fw-semibold">
                                Document Title <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-card-heading text-secondary"></i>
                                </span>
                                <input type="text" class="form-control" id="documentTitle" name="title" placeholder="Enter document title" maxlength="255" required>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-12">
                            <label for="documentDescription" class="form-label fw-semibold">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="documentDescription" name="description" rows="3" placeholder="Provide a brief description of the document" required></textarea>
                            <div class="form-text">
                                Add relevant details to help identify the document.
                            </div>
                        </div>
                        <!-- Category -->
                        <div class="col-12 col-md-6">
                            <label for="documentCategory" class="form-label fw-semibold">
                                Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="documentCategory" name="category" required>
                                <option value="" selected disabled>
                                    Select category
                                </option>
                                <option value="MEMORANDUM">Memorandum</option>
                                <option value="SPECIAL ORDER">Special Order</option>
                                <option value="RECEIVING COPY">Receiving Copy</option>
                                <option value="GRADESHEET">Gradesheet</option>
                                <option value="CLASS RECORD">Class Record</option>
                                <option value="TABLE OF SPECIFICATIONS">
                                    Table of Specifications
                                </option>
                            </select>
                        </div>
                        <!-- Document Type -->
                        <div class="col-12 col-md-6">
                            <label for="documentType" class="form-label fw-semibold">
                                Document Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="documentType" name="type" required>
                                <option value="Incoming" selected>Incoming</option>
                                <option value="Outgoing">Outgoing</option>
                            </select>
                        </div>

                        
                        <hr class="my-4">

                        <!-- Attachment Section -->
                        <h6 class="fw-bold mb-1">
                            <i class="bi bi-paperclip me-2"></i>
                            Document Attachment
                        </h6>
                        <p class="text-body-secondary small mb-2">
                            Upload an existing PDF or capture an urgent document using your camera.
                        </p>

                        <div class="row g-3">
                            <!-- PDF Upload -->
                            <div class="col-md-6">
                                <label for="pdf_file" class="border rounded-3 p-4 h-100 d-flex flex-column text-center align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-2"></i>
                                    <span class="fw-semibold">Upload PDF</span>
                                    <span class="small text-body-secondary mt-1">
                                        Select an existing PDF document
                                    </span>
                                    <span class="btn btn-outline-secondary btn-sm mt-3">
                                        <i class="bi bi-folder2-open me-1"></i>
                                        Browse PDF
                                    </span>
                                    <!-- PDF Status -->
                                    <span id="pdfStatus" class="small mt-3 text-body-secondary">
                                        <i class="bi bi-info-circle me-1"></i>
                                        No PDF selected
                                    </span>
                                </label>

                                <input type="file" class="form-control mt-2" id="pdf_file" name="pdf_file" accept=".pdf,application/pdf" hidden>
                            </div>

                            <!-- Camera Capture -->
                            <div class="col-md-6">
                                <div class="border rounded-3 p-4 h-100 d-flex flex-column text-center align-items-center justify-content-center">
                                    <i class="bi bi-camera text-success fs-1 mb-2"></i>
                                    <span class="fw-semibold">Use Camera</span>
                                    <span class="small text-body-secondary mt-1">
                                        Take a photo of an urgent document
                                    </span>
                                    <label for="camera_file"class="btn btn-outline-success btn-sm mt-3">
                                        <i class="bi bi-camera me-1"></i> Open Camera
                                    </label>
                                    <!-- Camera Status -->
                                    <span id="cameraStatus" class="small mt-3 text-body-secondary">
                                        <i class="bi bi-info-circle me-1"></i>
                                        No photo selected
                                    </span>
                                    <input type="file" class="form-control mt-2" id="camera_file" name="camera_file" accept="image/*" capture="environment" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light border-top px-4 py-3">
                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </button>
                    <button type="submit" name="add_document" class="btn btn-primary px-4">
                        <i class="bi bi-check2-circle me-2"></i> Save Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const pdfFile = document.getElementById('pdf_file');
const cameraFile = document.getElementById('camera_file');
const pdfStatus = document.getElementById('pdfStatus');
const cameraStatus = document.getElementById('cameraStatus');

// PDF selection
pdfFile.addEventListener('change', function () {
    if (this.files.length > 0) {
        const file = this.files[0];

        pdfStatus.className = 'small mt-3 text-success fw-semibold';
        pdfStatus.innerHTML =
            '<i class="bi bi-check-circle-fill me-1"></i> ' +
            'Selected: ' + escapeHtml(file.name);

        // Clear camera file to enforce one attachment only
        cameraFile.value = '';
        cameraStatus.className = 'small mt-3 text-body-secondary';
        cameraStatus.innerHTML =
            '<i class="bi bi-info-circle me-1"></i> No photo selected';
    } else {
        pdfStatus.className = 'small mt-3 text-body-secondary';
        pdfStatus.innerHTML =
            '<i class="bi bi-info-circle me-1"></i> No PDF selected';
    }
});

// Camera image selection or capture
cameraFile.addEventListener('change', function () {
    if (this.files.length > 0) {
        const file = this.files[0];

        cameraStatus.className = 'small mt-3 text-success fw-semibold';
        cameraStatus.innerHTML =
            '<i class="bi bi-check-circle-fill me-1"></i> ' +
            'Selected: ' + escapeHtml(file.name);

        // Clear PDF to enforce one attachment only
        pdfFile.value = '';
        pdfStatus.className = 'small mt-3 text-body-secondary';
        pdfStatus.innerHTML =
            '<i class="bi bi-info-circle me-1"></i> No PDF selected';
    } else {
        cameraStatus.className = 'small mt-3 text-body-secondary';
        cameraStatus.innerHTML =
            '<i class="bi bi-info-circle me-1"></i> No photo selected';
    }
});

// Safely display filenames
function escapeHtml(value) {
    return value.replace(/[&<>"']/g, function (character) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[character];
    });
}
</script>
