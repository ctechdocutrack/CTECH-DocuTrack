<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal"
     tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header border-0 p-4">
                <div>
                    <h5 class="modal-title fw-bold">Edit Profile</h5>
                    <p class="text-secondary small mb-0">
                        Update your account information.
                    </p>
                </div>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <form action="update_profile.php" method="POST">
                <div class="modal-body px-4 pt-0">

                    <input type="hidden" name="user_id"
                           value="<?= (int) $user['user_id'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Full Name
                        </label>
                        <input type="text" name="full_name"
                               class="form-control rounded-3"
                               value="<?= htmlspecialchars(
                                   $user['full_name'] ?? '',
                                   ENT_QUOTES,
                                   'UTF-8'
                               ) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Username
                        </label>
                        <input type="text" name="username"
                               class="form-control rounded-3"
                               value="<?= htmlspecialchars(
                                   $user['username'] ?? '',
                                   ENT_QUOTES,
                                   'UTF-8'
                               ) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email Address
                        </label>
                        <input type="email" name="email"
                               class="form-control rounded-3"
                               value="<?= htmlspecialchars(
                                   $user['email'] ?? '',
                                   ENT_QUOTES,
                                   'UTF-8'
                               ) ?>" required>
                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button"
                            class="btn btn-light rounded-3"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" name="update_profile"
                            class="btn btn-primary rounded-3 px-4">
                        <i class="bi bi-check-lg me-1"></i>
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>