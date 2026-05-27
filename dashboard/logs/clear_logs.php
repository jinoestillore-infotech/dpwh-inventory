<?php

include '../../config/db.php';

try {

    $pdo->exec("TRUNCATE TABLE system_logs");

    header("Location: logs.php?logs_cleared=1");
    exit;

} catch (PDOException $e) {

    header("Location: logs.php?logs_error=1");
    exit;

}