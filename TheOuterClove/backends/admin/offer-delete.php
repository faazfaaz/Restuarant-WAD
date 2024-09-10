<?php
session_start();

try {
    require_once('../connection-pdo.php');
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems on the server! Try again later.';
    header('location: ../../admin/offers-list.php');
    exit();
}

if (!isset($_GET['id'])) {
    $_SESSION['msg'] = 'Invalid offer ID! Refresh the page!';
    header('location: ../../admin/offers-list.php');
    exit();
}

$offer_id = $_GET['id'];

// Retrieve offer information to delete the associated image
$sql = "SELECT offer_image FROM offers WHERE offer_id = ?";
$query = $pdoconn->prepare($sql);
$query->execute([$offer_id]);
$offer = $query->fetch(PDO::FETCH_ASSOC);

if (!$offer) {
    $_SESSION['msg'] = 'Offer not found!';
    header('location: ../../admin/offers-list.php');
    exit();
}

// Delete the offer and its associated image
$sqlDelete = "DELETE FROM offers WHERE offer_id = ?";
$queryDelete = $pdoconn->prepare($sqlDelete);

if ($queryDelete->execute([$offer_id])) {
    // Delete the image file
    $upload_dir = '/TheOuterClove/images/'; // Set your upload directory
    $offer_image = $offer['offer_image'];

    if ($offer_image && file_exists($upload_dir . $offer_image)) {
        unlink($upload_dir . $offer_image);
    }

    $_SESSION['msg'] = 'Offer Deleted!';
} else {
    $_SESSION['msg'] = 'There were some problems on the server! Please try again later.';
}

header('location: ../../admin/offers-list.php');
exit();
?>
