<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['can_add_asset'] = $user['can_add_asset'];
        $_SESSION['can_edit_asset'] = $user['can_edit_asset'];
        $_SESSION['can_delete_asset'] = $user['can_delete_asset'];

        header("Location: ../dashboard/dashboard.php");
        exit();

    } else {
        header("Location: /DPWH-SITE/index.php?error=Incorrect email or password.");
        exit();
    }
}
?>