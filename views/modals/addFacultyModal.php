<!-- Add Faculty Account Modal -->
<?php if (strtolower(trim($user['role'] ?? '')) === 'admin'): ?>

<div class="modal fade" id="addFacultyModal" tabindex="-1"
     aria-labelledby="addFacultyModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <form action="../controller/addFacultyAccountController.php" method="POST">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold" id="addFacultyModalLabel">
                            <i class="bi bi-person-plus text-success me-2"></i> Add Faculty Account
                        </h5>
                        <p class="text-secondary small mb-0">
                            Create a new faculty login account.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label for="facultyFullName" class="form-label">
                            Full Name
                        </label>
                        <input type="text" name="full_name"
                               id="facultyFullName"
                               class="form-control"
                               placeholder="Enter faculty full name"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="facultyUsername" class="form-label">
                            Username
                        </label>
                        <input type="text" name="username"
                               id="facultyUsername"
                               class="form-control"
                               placeholder="Create a username"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="facultyEmail" class="form-label">
                            Email Address
                        </label>
                        <input type="email" name="email"
                               id="facultyEmail"
                               class="form-control"
                               placeholder="Enter email address"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="facultyEmail" class="form-label">
                            Role
                        </label>
                        <select class="form-select"
                                name="role"
                                id="facultyRole">
                            <option value="staff" selected>Staff</option>
                            <option value="faculty" selected>Faculty</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="facultyPassword" class="form-label">
                            Initial Password
                        </label>

                        <div class="input-group">
                            <input type="password"
                                name="password"
                                id="facultyPassword"
                                class="form-control"
                                minlength="8"
                                placeholder="Generate a strong password"
                                required>

                            <button type="button"
                                    class="btn btn-outline-secondary"
                                    id="toggleFacultyPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <button type="button"
                                class="btn btn-outline-success btn-sm mt-2"
                                id="generateFacultyPassword">
                            <i class="bi bi-shield-lock me-1"></i>
                            Generate Strong Password
                        </button>

                        <div class="form-text">
                            Give this temporary password to the faculty member.
                            They should change it after their first login.
                        </div>
                    </div>

                    <div class="alert alert-info small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        This account will automatically be assigned the Faculty role.
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-3"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" name="add_faculty"
                            class="btn btn-success rounded-3">
                        <i class="bi bi-person-plus me-1"></i>
                        Create Account
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php endif; ?>