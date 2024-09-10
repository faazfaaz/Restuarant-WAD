<?php
session_start();

try {
    if (!file_exists('../connection-pdo.php')) {
        throw new Exception();
    } else {
        require_once('../connection-pdo.php');
    }
} catch (Exception $e) {
    $_SESSION['msg'] = 'There were some problems on the server! Try again later.';
    header('location: ../../staff/food-list.php');
    exit();
}

if (
    !isset($_POST['id']) ||
    !isset($_POST['name']) ||
    !isset($_POST['desc']) ||
    !isset($_POST['price']) ||
    !isset($_POST['category']))
 {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: ../../staff/food-list.php');
    exit();
}

$regex = '/^[(A-Z)?(a-z)?(0-9)?\-?\_?\.?\s*]+$/';

if (
    !is_numeric($_POST['id']) ||
    !preg_match($regex, $_POST['name']) ||
    !preg_match($regex, $_POST['desc']) ||
    !is_numeric($_POST['price']) ||
    !preg_match($regex, $_POST['category'])
) {
    $_SESSION['msg'] = 'Whoa! Invalid Inputs!';
    header('location: ../../staff/food-list.php');
    exit();
} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle uploaded image
    if (isset($_FILES['food_image']) && $_FILES['food_image']['size'] > 0) {
        $uploadDir = '../../images/';
        $uploadFile = $uploadDir . basename($_FILES['food_image']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['food_image']['tmp_name']);
        if ($check === false) {
            $_SESSION['msg'] = 'File is not an image.';
            header('location: ../../staff/food-list.php');
            exit();
        }

        if ($_FILES['food_image']['size'] > 500000) {
            $_SESSION['msg'] = 'Sorry, your file is too large.';
            header('location: ../../staff/food-list.php');
            exit();
        }

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowedExtensions)) {
            $_SESSION['msg'] = 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed.';
            header('location: ../../staff/food-list.php');
            exit();
        }

        if (move_uploaded_file($_FILES['food_image']['tmp_name'], $uploadFile)) {
            // Image uploaded successfully, you can save the filename in the database
            $imageName = basename($_FILES['food_image']['name']);
            $updateImageSql = "UPDATE food SET image = ? WHERE id = ?";
            $updateImageQuery = $pdoconn->prepare($updateImageSql);
            if (!$updateImageQuery->execute([$imageName, $id])) {
                $_SESSION['msg'] = 'Failed to update image! Please try again later.';
                error_log('Image update failed: ' . implode(' ', $updateImageQuery->errorInfo()));
                header('location: ../../staff/food-list.php');
                exit();
            }
        } else {
            // Image upload failed
            $_SESSION['msg'] = 'Image upload failed!';
            header('location: ../../staff/food-list.php');
            exit();
        }
    }

    $updateSql = "UPDATE food SET cat_id = ?, fname = ?, description = ?, price = ? WHERE id = ?";
    $updateQuery = $pdoconn->prepare($updateSql);
    if ($updateQuery->execute([$category, $name, $desc, $price, $id])) {
        $_SESSION['msg'] = 'Food Updated!';
        header('location: ../../staff/food-list.php');
    } else {
        $_SESSION['msg'] = 'There were some problems on the server! Please try again later.';
        header('location: ../../staff/food-list.php');
    }
}
?>
