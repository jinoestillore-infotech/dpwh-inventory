<?php

include '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    $stmtOld = $pdo->prepare("SELECT * FROM assets WHERE id=?");
    $stmtOld->execute([$id]);
    $old = $stmtOld->fetch();

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $device_issued = $_POST['device_issued'];
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial_number'];
    $date_purchased = $_POST['date_purchased'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $sql = "UPDATE assets SET
        first_name=?,
        last_name=?,
        device_issued=?,
        manufacturer=?,
        model=?,
        serial_number=?,
        date_purchased=?,
        amount=?,
        status=?
        WHERE id=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $first_name,
        $last_name,
        $device_issued,
        $manufacturer,
        $model,
        $serial_number,
        $date_purchased,
        $amount,
        $status,
        $id
    ]);

    $changes = [];

    if ($old['first_name'] != $first_name)
        $changes[] = "First Name: {$old['first_name']} → $first_name";

    if ($old['last_name'] != $last_name)
        $changes[] = "Last Name: {$old['last_name']} → $last_name";

    if ($old['device_issued'] != $device_issued)
        $changes[] = "Device: {$old['device_issued']} → $device_issued";

    if ($old['manufacturer'] != $manufacturer)
        $changes[] = "Manufacturer: {$old['manufacturer']} → $manufacturer";

    if ($old['model'] != $model)
        $changes[] = "Model: {$old['model']} → $model";

    if ($old['serial_number'] != $serial_number)
        $changes[] = "Serial: {$old['serial_number']} → $serial_number";

    if ($old['status'] != $status)
        $changes[] = "Status: {$old['status']} → $status";

    if (!empty($changes)) {

        $description = "Asset updated (ID:$id) — " . implode(", ", $changes);

        $log = $pdo->prepare("
            INSERT INTO system_logs (action, description, user_name)
            VALUES ('UPDATE', :description, 'Admin')
            ");

        $log->execute([
            ':description' => $description
        ]);
    }

    header("Location: ../dashboard.php?updated=1");
    exit;
}
