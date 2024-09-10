<?php
session_start();

try {
    require_once('../connection-pdo.php');
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems in the Server! Try again after some time!';
    header('location: ../../admin/staff-list.php');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['msg'] = 'Invalid ID!';
    header('location: ../../admin/staff-list.php');
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM staff WHERE id = ?";
$query = $pdoconn->prepare($sql);

if ($query->execute([$id])) {
    $_SESSION['msg'] = 'Staff Member Deleted!';
    header('location: ../../admin/staff-list.php');
} else {
    $_SESSION['msg'] = 'There were some problems in the server! Please try again after some time!';
    header('location: ../../admin/staff-list.php');
}
?>
