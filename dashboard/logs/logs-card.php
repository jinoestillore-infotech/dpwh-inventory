<section id="historySection" class="card shadow-sm rounded-0 mt-5 border-primary-var">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
            <div>
                <h5 class="fw-bold d-flex align-items-center gap-2 mb-0">
                    SYSTEM ACTIVITY LOGS
                </h5>
                <small class="text-muted">Property and Asset Creation</small>
            </div>

            <button id="clearLogsBtn" class="btn btn-sm border-0 btn-outline-danger">
                Clear Logs
            </button>
        </div>

        <div id="logContainer" style="max-height:300px; overflow-y:auto;" class="d-flex flex-column gap-2">

            <?php

            $sqlLogs = "SELECT * FROM system_logs ORDER BY created_at DESC LIMIT 50";
            $stmtLogs = $pdo->query($sqlLogs);
            $logs = $stmtLogs->fetchAll();

            if ($logs) {
                foreach ($logs as $log) {

                    $time = date("h:i A", strtotime($log['created_at']));
                    $user = htmlspecialchars($log['user_name']);
                    $action = htmlspecialchars($log['action']);
                    $detail = htmlspecialchars($log['description']);

            ?>

                    <div class="small border-bottom pb-1">

                        <span class="fw-bold text-primary">
                            [<?php echo $time; ?>]
                        </span>

                        <span class="fw-semibold text-dark">
                            <?php echo $user; ?>
                        </span>

                        <span class="text-muted">
                            <?php echo $action; ?>:
                        </span>

                        <span class="fst-italic text-secondary">
                            <?php echo $detail; ?>
                        </span>

                    </div>

            <?php

                }
            } else {
                echo "<div class='text-muted small'>No system logs available.</div>";
            }

            ?>

        </div>

    </div>

</section>

