<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /DPWH-SITE/index.php?error=Please login first.");
    exit();
}

include '../config/db.php'; 

// Total Valuation
$totalValueQuery = $pdo->query("SELECT SUM(amount) AS total_value FROM assets");
$totalValue = $totalValueQuery->fetch()['total_value'] ?? 0;

// Total Assets
$totalAssetsQuery = $pdo->query("SELECT COUNT(*) AS total_assets FROM assets");
$totalAssets = $totalAssetsQuery->fetch()['total_assets'] ?? 0;

// Assets Under Repair
$repairQuery = $pdo->query("SELECT COUNT(*) AS repair_count FROM assets WHERE status = 'Repair'");
$repairCount = $repairQuery->fetch()['repair_count'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH IT — Dashboard</title>

    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">

            <div class="col-3 col-md-3 col-lg-2 bg-primary-var">
                <?php include 'sidebar.php'; ?>
            </div>

            <div class="col-9 col-md-9 col-lg-10 bg-light p-3 p-md-4">

                <?php include './inventory/cards.php'; ?>
                <?php include './inventory/inventory.php'; ?>

            </div>

        </div>
    </div>

    <script src="../bootstrap/bootstrap.bundle.min.js"></script>

</body>

</html>