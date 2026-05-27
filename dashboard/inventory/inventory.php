<?php

include './../config/db.php';

$sql = "SELECT * FROM assets ORDER BY created_at DESC";
$result = $pdo->query($sql);
?>

<style>
    .table-scroll {
        max-height: 450px;
        overflow-y: auto;
    }

    .table-scroll thead th {
        position: sticky;
        top: 0;
        background: #f8f9fa;
        z-index: 2;
    }
</style>


<div class="card shadow-sm border-primary-var rounded-0 mt-5">

    <div class="card-body p-4">

        <div class="row align-items-center mb-4 g-3">

            <div class="col-md">
                <h5 class="fw-bold text-uppercase mb-1">Master Inventory Record</h5>
                <small class="text-muted">Property and Asset Management Ledger</small>
            </div>

            <div class="col-md-auto">
                <div class="d-flex gap-2">

                    <input type="text" id="searchInput" class="form-control form-control-sm"
                        placeholder="Search..." style="width:220px;">

                    <button id="exportBtn" class="btn btn-success btn-sm fw-bold">
                        EXPORT
                    </button>

                </div>
            </div>

        </div>

        <div class="mb-3 d-flex gap-2 justify-content-end">
            <button class="btn btn-sm btn-outline-primary filter-btn active" data-status="all">All</button>
            <button class="btn btn-sm btn-outline-danger filter-btn" data-status="Repair">Repair</button>
            <button class="btn btn-sm btn-outline-warning filter-btn" data-status="Returned">Returned</button>
            <button class="btn btn-sm btn-outline-success filter-btn" data-status="Assigned">Assigned</button>
        </div>

        <div class="table-responsive border rounded table-scroll">

            <table id="inventoryTable" class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr class="small">
                        <th>Employee</th>
                        <th>Device</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial No.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody id="assignmentTable">

                    <?php
                    $rows = $result->fetchAll();

                    if ($rows) {
                        foreach ($rows as $row) {
                    ?>
                            <tr class="small">
                                <td>
                                    <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['device_issued']); ?></td>
                                <td><?php echo htmlspecialchars($row['manufacturer']); ?></td>
                                <td><?php echo htmlspecialchars($row['model']); ?></td>
                                <td><?php echo htmlspecialchars($row['serial_number']); ?></td>
                                <td>
                                    <?php echo date("M d, Y", strtotime($row['date_purchased'])); ?>
                                </td>
                                <td>
                                    ₱ <?php echo number_format($row['amount'], 2); ?>
                                </td>
                                <td>
                                    <span class="badge 
                                <?php
                                if ($row['status'] == 'Assigned') echo 'bg-success';
                                elseif ($row['status'] == 'Repair') echo 'bg-danger';
                                else echo 'bg-warning text-dark';
                                ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>

                                <td class="text-end">

                                    <!-- EDIT BUTTON -->
                                    <?php if (!empty($_SESSION['can_edit_asset'])) { ?>
                                        <a
                                            href="./assets/asset.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-outline-primary m-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    <?php } else { ?>
                                        <button class="btn btn-sm btn-outline-secondary m-1" disabled>
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    <?php } ?>

                                    <!-- DELETE BUTTON -->
                                    <?php if (!empty($_SESSION['can_delete_asset'])) { ?>
                                        <a
                                            href="./assets/delete_asset.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-outline-danger m-1"
                                            onclick="return confirm('Are you sure you want to delete this asset?');">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    <?php } else { ?>
                                        <button class="btn btn-sm btn-outline-secondary m-1" disabled>
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    <?php } ?>

                                </td>

                            </tr>

                    <?php
                        }
                    }
                    ?>

                </tbody>

            </table>

        </div>

        <div id="emptyState" class="text-center py-5 text-muted d-none">
            <p class="mb-0">No matching assets found in the registry.</p>
        </div>

    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {

        let filter = this.value.toLowerCase();
        let table = document.getElementById("inventoryTable");
        let rows = table.querySelectorAll("tbody tr");
        let visible = 0;

        rows.forEach(row => {

            let text = row.textContent.toLowerCase();

            if (text.includes(filter)) {
                row.style.display = "";
                visible++;
            } else {
                row.style.display = "none";
            }

        });

        let emptyState = document.getElementById("emptyState");

        if (visible === 0) {
            emptyState.classList.remove("d-none");
        } else {
            emptyState.classList.add("d-none");
        }

    });

    document.getElementById("exportBtn").addEventListener("click", function() {

        let table = document.getElementById("inventoryTable");
        let rows = table.querySelectorAll("tr");
        let csv = [];

        rows.forEach(row => {

            let cols = row.querySelectorAll("th, td");
            let rowData = [];

            cols.forEach((col, index) => {

                if (index === cols.length - 1) return;

                rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
            });

            csv.push(rowData.join(","));
        });

        let csvFile = new Blob(["\uFEFF" + csv.join("\n")], {
            type: "text/csv;charset=utf-8;"
        });

        let downloadLink = document.createElement("a");
        downloadLink.download = "asset_inventory.csv";
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);

    });

    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const status = btn.getAttribute('data-status');

            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const rows = document.querySelectorAll('#assignmentTable tr');
            rows.forEach(row => {
                const rowStatus = row.querySelector('td:nth-child(8) span').innerText.trim();
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            const visibleRows = Array.from(rows).filter(r => r.style.display !== 'none').length;
            const emptyState = document.getElementById('emptyState');
            if (visibleRows === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        });
    });

</script>