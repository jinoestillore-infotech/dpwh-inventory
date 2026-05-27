<?php
session_start();
include '../../config/db.php';

if ($_SESSION['role'] !== 'admin') {
    exit("Unauthorized");
}

$updateStmt = $pdo->prepare("
    UPDATE users 
    SET can_add_asset = ?, can_edit_asset = ?, can_delete_asset = ? 
    WHERE id = ?
");

$logStmt = $pdo->prepare("
    INSERT INTO system_logs (action, description, user_name)
    VALUES ('PERMISSION_UPDATE', :description, :user_name)
");

foreach ($_POST['user_id'] as $id) {

    $newAdd = isset($_POST['add_' . $id]) ? 1 : 0;
    $newEdit = isset($_POST['edit_' . $id]) ? 1 : 0;
    $newDelete = isset($_POST['delete_' . $id]) ? 1 : 0;

    $stmt = $pdo->prepare("SELECT username, can_add_asset, can_edit_asset, can_delete_asset FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) continue;

    $changes = [];

    if ($user['can_add_asset'] != $newAdd) {
        $status = $newAdd ? "Activated" : "Deactivated";
        $changes[] = "Permission — Add Asset $status";
    }

    if ($user['can_edit_asset'] != $newEdit) {
        $status = $newEdit ? "Activated" : "Deactivated";
        $changes[] = "Permission — Edit Asset $status";
    }

    if ($user['can_delete_asset'] != $newDelete) {
        $status = $newDelete ? "Activated" : "Deactivated";
        $changes[] = "Permission — Delete Asset $status";
    }

    if (!empty($changes)) {
        $description = "Updated permissions for user '{$user['username']}': " . implode(", ", $changes);
        $logStmt->execute([
            ':description' => $description,
            ':user_name' => $_SESSION['username']
        ]);
    }

    $updateStmt->execute([$newAdd, $newEdit, $newDelete, $id]);

    if ($id == $_SESSION['user_id']) {
        $_SESSION['can_add_asset'] = $newAdd;
        $_SESSION['can_edit_asset'] = $newEdit;
        $_SESSION['can_delete_asset'] = $newDelete;
    }
}

header("Location: user_permissions.php?success=1");
exit;
