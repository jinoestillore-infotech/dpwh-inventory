<?php

include './../config/db.php';

$asset = [];

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM assets WHERE id=?");
    $stmt->execute([$id]);

    $asset = $stmt->fetch();
}
?>