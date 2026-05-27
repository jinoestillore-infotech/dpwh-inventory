<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        header("Location: ../index.php?error=Passwords do not match&form=register");
        exit();
    }

    if(strlen($password) < 8){
        header("Location: ../index.php?error=Password must be at least 8 characters&form=register");
        exit();
    }

    $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $check->execute([$username]);

    if($check->fetch()){
        header("Location: ../index.php?error=Username already exists&form=register");
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed]);

    header("Location: ../index.php?success=Account created successfully");
    exit();
}