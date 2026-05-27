
<div class="card shadow-sm border-primary-var rounded-0 mt-5">

    <div class="card-header bg-white border-bottom mt-3">
        <h5 class="fw-bold d-flex align-items-center gap-2 mb-1">
            ASSET REGISTRATION FORM
        </h5>
        <small class="text-muted">Property and Asset Creation</small>
    </div>

    <div class="card-body">

        <form id="assetFormElement" method="POST" action="<?php echo !empty($asset['id']) ? 'update_asset.php' : 'save_asset.php'; ?>">
            <input type="hidden" name="id" value="<?php echo $asset['id'] ?? ''; ?>">
            <div class="row g-3">

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">FIRST NAME</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $asset['first_name']; ?>" required>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">LAST NAME</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $asset['last_name']; ?>" required>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">DEVICE ISSUED</label>
                    <select name="device_issued" class="form-select">
                        <option value="PC" <?php if ($asset['device_issued'] == "PC") echo "selected"; ?>>PC (DESKTOP)</option>
                        <option value="Laptop" <?php if ($asset['device_issued'] == "Laptop") echo "selected"; ?>>LAPTOP</option>
                        <option value="Printer" <?php if ($asset['device_issued'] == "Printer") echo "selected"; ?>>PRINTER</option>
                        <option value="Mobile" <?php if ($asset['device_issued'] == "Mobile") echo "selected"; ?>>MOBILE DEVICE</option>
                        <option value="Others" <?php if ($asset['device_issued'] == "Others") echo "selected"; ?>>OTHERS</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">MANUFACTURER</label>
                    <input type="text" name="manufacturer" class="form-control" value="<?php echo $asset['manufacturer']; ?>">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">MODEL</label>
                    <input type="text" name="model" class="form-control" value="<?php echo $asset['model']; ?>">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">SERIAL NUMBER</label>
                    <input type="text" name="serial_number" class="form-control" value="<?php echo $asset['serial_number']; ?>" required>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">DATE PURCHASED</label>
                    <input type="date" name="date_purchased" class="form-control" value="<?php echo $asset['date_purchased']; ?>">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">AMOUNT (PHP)</label>
                    <input type="number" name="amount" class="form-control" value="<?php echo $asset['amount']; ?>" min="0" step="0.01">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">STATUS</label>
                    <select name="status" class="form-select">
                        <option value="Assigned" <?php if ($asset['status'] == "Assigned") echo "selected"; ?>>ASSIGNED</option>
                        <option value="Repair" <?php if ($asset['status'] == "Repair") echo "selected"; ?>>UNDER REPAIR</option>
                        <option value="Returned" <?php if ($asset['status'] == "Returned") echo "selected"; ?>>STOCK / RETURNED</option>
                    </select>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <?php if($_SESSION['can_add_asset']){ ?>
                    <button type="submit" class="btn btn-primary fw-bold">
                        <?php echo !empty($asset['id']) ? 'UPDATE ASSET' : 'SAVE TO LEDGER'; ?>
                    </button>

                <?php } else { ?>
                    <button type="submit" class="btn btn-secondary fw-bold" disabled>
                        <?php echo !empty($asset['id']) ? 'UPDATE ASSET' : 'SAVE TO LEDGER'; ?>
                    </button>

                <?php } ?>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='../dashboard.php'">
                        Cancel
                    </button>
            </div>
        </form>
    </div>
</div>