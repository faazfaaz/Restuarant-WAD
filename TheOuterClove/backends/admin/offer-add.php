<?php
session_start();

try {
    require_once('../connection-pdo.php');
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems in the Server! Try again after some time!';
    header('location: ../../admin/offers-list.php');
    exit();
}

if (!isset($_POST['offer_title'], $_POST['offer_description'])) {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: ../../admin/offers-list.php');
    exit();
}

$regex = '/^[A-Za-z0-9\s]+$/';

if (!preg_match($regex, $_POST['offer_title'])) {
    $_SESSION['msg'] = 'Whoa! Invalid Inputs!';
    header('location: ../../admin/offers-list.php');
    exit();
}

$offer_title = $_POST['offer_title'];
$offer_description = $_POST['offer_description'];

// Handle image upload
$upload_dir = '/TheOuterClove/images/'; // Set your upload directory
$offer_image = ''; // Initialize variable to store image filename

if (isset($_FILES['offer_image'])) {
    $file_name = $_FILES['offer_image']['name'];
    $file_tmp = $_FILES['offer_image']['tmp_name'];

    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    $offer_image = $file_name;
}

$sql = "INSERT INTO offers (offer_title, offer_description, offer_image) VALUES (?, ?, ?)";
$query = $pdoconn->prepare($sql);

if ($query->execute([$offer_title, $offer_description, $offer_image])) {
    $_SESSION['msg'] = 'Offer Added!';
    header('location: ../../admin/offers-list.php');
} else {
    $_SESSION['msg'] = 'There were some problems in the server! Please try again after some time!';
    header('location: ../../admin/offers-list.php');
}
?>
