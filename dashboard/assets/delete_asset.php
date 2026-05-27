<?php

include '../../config/db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmtOld = $pdo->prepare("SELECT * FROM assets WHERE id=?");
    $stmtOld->execute([$id]);
    $asset = $stmtOld->fetch();

    if($asset){

        $first_name = $asset['first_name'];
        $last_name = $asset['last_name'];
        $device = $asset['device_issued'];
        $serial = $asset['serial_number'];

        $stmt = $pdo->prepare("DELETE FROM assets WHERE id=?");
        $stmt->execute([$id]);

        $description = "Asset deleted: $first_name $last_name ($device - SN: $serial)";

        $log = $pdo->prepare("
            INSERT INTO system_logs (action, description, user_name)
            VALUES ('DELETE', :description, 'Admin')
        ");

        $log->execute([
            ':description' => $description
        ]);

    }

    header("Location: ../dashboard.php?deleted=1");
    exit;
}