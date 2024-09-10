<?php
session_start();
include_once("../backends/connection-pdo.php");

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: index.php'); 
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM staff WHERE email=? AND password=?";
$query = $pdoconn->prepare($sql);
$query->execute([$email, $password]);
$arr_login = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($arr_login) > 0) {
    foreach ($arr_login as $val) {
        $tmp_name = $val['staff_name'];
    }

    $_SESSION['username'] = $tmp_name;
    $_SESSION['msg'] = "You have successfully Logged In!";
    header('location: dashboard.php');
} else {
    $_SESSION['msg'] = "Invalid Credentials!";
    header('location: index.php'); 
}
?>
