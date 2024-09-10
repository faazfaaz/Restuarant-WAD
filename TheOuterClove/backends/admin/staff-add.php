<?php
session_start();

try {
    require_once('../connection-pdo.php');
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems in the Server! Try again after some time!';
    header('location: ../../admin/staff-list.php');
    exit();
}

if (!isset($_POST['name'], $_POST['position'], $_POST['age'], $_POST['email'], $_POST['password'], $_POST['gender'], $_POST['address'], $_POST['phone'])) {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: ../../admin/staff-list.php');
    exit();
}

$regex = '/^[A-Za-z0-9\s]+$/';

if (!preg_match($regex, $_POST['name']) || !preg_match($regex, $_POST['position'])) {
    $_SESSION['msg'] = 'Whoa! Invalid Inputs!';
    header('location: ../../admin/staff-list.php');
    exit();
}

$name = $_POST['name'];
$position = $_POST['position'];
$age = $_POST['age'];
$email = $_POST['email'];
$password = $_POST['password']; 
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "INSERT INTO staff (staff_name, position, age, email, password, gender, address, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$query = $pdoconn->prepare($sql);

if ($query->execute([$name, $position, $age, $email, $password, $gender, $address, $phone])) {
    $_SESSION['msg'] = 'Staff Member Added!';
    header('location: ../../admin/staff-list.php');
} else {
    $_SESSION['msg'] = 'There were some problems in the server! Please try again after some time!';
    header('location: ../../admin/staff-list.php');
}
?>
