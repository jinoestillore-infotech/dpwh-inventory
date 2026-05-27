<div class="mb-4 mt-5">
    <div class="row g-4">

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm border-start border-4 border-primary rounded-0 h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted fw-bold mb-1 small">Total Valuation</p>
                    <h3 id="statTotalValue" class="fw-bold text-dark text-truncate">
                        <?php echo number_format($totalValue, 2); ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm border border-4 border-success rounded-0 h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted fw-bold mb-1 small">Total Assets</p>
                    <h3 id="statTotalCount" class="fw-bold text-dark">
                        <?php echo $totalAssets; ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm border-start border-4 border-danger rounded-0 h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted fw-bold mb-1 small">For Repair</p>
                    <h3 id="statRepairCount" class="fw-bold text-dark">
                        <?php echo $repairCount; ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm border-start border-4 border-secondary rounded-0 h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted fw-bold mb-1 small">System Time</p>
                    <h3 id="liveClock" class="font-monospace text-secondary">00:00:00</h3>
                </div>
            </div>
        </div>

    </div>
</div>

<?php if (isset($_GET['success']) || isset($_GET['updated']) || isset($_GET['deleted'])): ?>

    <div class="mb-4 mt-2">
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-0" role="alert" id="assetAlert">

            <?php if (isset($_GET['success'])): ?>
                <strong>Success:</strong> Asset has been saved to the ledger.
            <?php endif; ?>

            <?php if (isset($_GET['updated'])): ?>
                <strong>Updated:</strong> Asset has been successfully updated.
            <?php endif; ?>

            <?php if (isset($_GET['deleted'])): ?>
                <strong>Deleted:</strong> Asset has been removed from the ledger.
            <?php endif; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>
    </div>

<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const alertBox = document.getElementById("assetAlert");

        if (alertBox) {

            setTimeout(() => {

                alertBox.classList.remove("show");

                setTimeout(() => {
                    alertBox.remove();
                }, 500);

            }, 2000);

        }

    });

    function updateClock() {
        const now = new Date();

        const time = now.toLocaleTimeString();

        document.getElementById("liveClock").textContent = time;
    }

    setInterval(updateClock, 1000);
    updateClock();
    
</script>