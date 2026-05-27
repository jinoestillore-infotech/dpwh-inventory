<?php
session_start();
include '../../config/db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

$totalValueQuery = $pdo->query("SELECT SUM(amount) AS total_value FROM assets");
$totalValue = $totalValueQuery->fetch()['total_value'] ?? 0;

$totalAssetsQuery = $pdo->query("SELECT COUNT(*) AS total_assets FROM assets");
$totalAssets = $totalAssetsQuery->fetch()['total_assets'] ?? 0;

$repairQuery = $pdo->query("SELECT COUNT(*) AS repair_count FROM assets WHERE status = 'Repair'");
$repairCount = $repairQuery->fetch()['repair_count'] ?? 0;


$stmt = $pdo->query("SELECT id, username, role, can_add_asset, can_edit_asset, can_delete_asset FROM users ORDER BY username ASC");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH IT — User Permissions</title>

    <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="../../style.css">

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

</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">

            <div class="col-3 col-md-3 col-lg-2 bg-primary-var p-0">
                <?php include '../user/sidebar.php'; ?>
            </div>

            <div class="col-lg-10 col-md-9 col-12 p-4 bg-light">
                <?php
                include '../inventory/cards.php'
                ?>
                <?php
                include './card.php'
                ?>
            </div>
        </div>
    </div>
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
    </script>

</body>

</html>