<?php
session_start();

try {
    require_once('../connection-pdo.php');
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems in the Server! Try again after some time!';
    header('location: ../../admin/staff-list.php');
    exit();
}

if (
    !isset($_POST['id']) ||
    !isset($_POST['name']) ||
    !isset($_POST['position']) ||
    !isset($_POST['email']) ||
    !isset($_POST['password']) ||
    !isset($_POST['address']) ||
    !isset($_POST['phone'])
) {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: ../../admin/staff-list.php');
    exit();
}

$id = $_POST['id'];
$name = $_POST['name'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$updateSql = "UPDATE staff SET staff_name = ?, position = ?, age = ?, email = ?, password = ?, gender = ?, address = ?, phone = ? WHERE id = ?";
$updateQuery = $pdoconn->prepare($updateSql);

if ($updateQuery->execute([$name, $position, $age, $email, $password, $gender, $address, $phone, $id])) {
    $_SESSION['msg'] = 'Staff Member Updated!';
    header('location: ../../admin/staff-list.php');
} else {
    $_SESSION['msg'] = 'There were some problems in the server! Please try again after some time!';
    header('location: ../../admin/staff-list.php');
}
