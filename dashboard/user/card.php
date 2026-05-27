<div class="card shadow-sm border-primary-var rounded-0 mt-5">
                    <div class="card-body p-4">
                        <!-- <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="assetAlert">
                                <i class="bi bi-check-circle me-1"></i>
                                Permissions updated successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?> -->
                        <div class="row align-items-center mb-4 g-3">
                            <div class="col-md">
                                <h5 class="fw-bold text-uppercase mb-1">User Permission Manager</h5>
                                <small class="text-muted">Control asset access privileges</small>
                            </div>
                            <div class="col-md-auto">
                                <button form="permissionForm" class="btn btn-primary btn-sm fw-bold">
                                    <i class="bi bi-save me-1"></i>
                                    SAVE PERMISSIONS
                                </button>
                            </div>
                        </div>
                        <form id="permissionForm" method="POST" action="update_permissions.php">
                            <div class="table-responsive border rounded table-scroll">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="small">
                                            <th>User</th>
                                            <th>Role</th>
                                            <th class="text-center">Add Asset</th>
                                            <th class="text-center">Edit Asset</th>
                                            <th class="text-center">Delete Asset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) { ?>
                                            <tr class="small">
                                                <td>
                                                    <?php echo htmlspecialchars($user['username']); ?>
                                                    <input type="hidden" name="user_id[]" value="<?php echo $user['id']; ?>">
                                                </td>
                                                <td>
                                                    <span class="badge <?php echo ($user['role'] === 'admin') ? 'bg-success' : 'bg-secondary'; ?>">
                                                        <?php echo htmlspecialchars($user['role']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <input
                                                        type="checkbox"
                                                        name="add_<?php echo $user['id']; ?>"
                                                        class="form-check-input"
                                                        <?php if ($user['can_add_asset']) echo "checked"; ?>>
                                                </td>
                                                <td class="text-center">
                                                    <input
                                                        type="checkbox"
                                                        name="edit_<?php echo $user['id']; ?>"
                                                        class="form-check-input"
                                                        <?php if ($user['can_edit_asset']) echo "checked"; ?>>
                                                </td>
                                                <td class="text-center">
                                                    <input
                                                        type="checkbox"
                                                        name="delete_<?php echo $user['id']; ?>"
                                                        class="form-check-input"
                                                        <?php if ($user['can_delete_asset']) echo "checked"; ?>>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>