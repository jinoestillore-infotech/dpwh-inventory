<?php

include '../../config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $device_issued = $_POST['device_issued'];
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial_number'];
    $date_purchased = $_POST['date_purchased'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $sql = "INSERT INTO assets 
            (first_name, last_name, device_issued, manufacturer, model, serial_number, date_purchased, amount, status)
            VALUES 
            (:first_name, :last_name, :device_issued, :manufacturer, :model, :serial_number, :date_purchased, :amount, :status)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':device_issued' => $device_issued,
        ':manufacturer' => $manufacturer,
        ':model' => $model,
        ':serial_number' => $serial_number,
        ':date_purchased' => $date_purchased,
        ':amount' => $amount,
        ':status' => $status
    ]);

    $log = $pdo->prepare("INSERT INTO system_logs (action, description, user_name)
    VALUES ('CREATE', :description, 'Admin')");

    $log->execute([
        ':description' => "New asset added: $device_issued - SN: $serial_number - for: $first_name $last_name"
    ]);

    header("Location: ../dashboard.php?success=1");
}