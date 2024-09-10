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
    !isset($_POST['name']) ||
    !isset($_POST['desc']) ||
    !isset($_POST['price']) ||
    !isset($_POST['category'])
) {
    $_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';
    header('location: ../../staff/food-list.php');
    exit();
}

$regex = '/^[(A-Z)?(a-z)?(0-9)?\-?\_?\.?\s*]+$/';

if (
    !preg_match($regex, $_POST['name']) ||
    !preg_match($regex, $_POST['desc']) ||
    !is_numeric($_POST['price']) ||
    !preg_match($regex, $_POST['category'])
) {
    $_SESSION['msg'] = 'Whoa! Invalid Inputs!';
    header('location: ../../staff/food-list.php');
    exit();
} else {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    
    $uploadDir = '../../images/'; 
    $uploadFile = $uploadDir . basename($_FILES['food_image']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES['food_image']['tmp_name']);
    if ($check === false) {
        $_SESSION['msg'] = 'File is not an image.';
        header('location: ../../staff/food-list.php');
        exit();
    }

    
    if ($_FILES['food_image']['size'] > 500000) { // Adjust the size limit as needed
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
        
        $imageName = basename($_FILES['food_image']['name']);

        $sql = "INSERT INTO food (cat_id, fname, description, price, image) VALUES (?, ?, ?, ?, ?)";
        $query = $pdoconn->prepare($sql);
        if ($query->execute([$category, $name, $desc, $price, $imageName])) {
            $_SESSION['msg'] = 'Food Added!';
            header('location: ../../staff/food-list.php');
        } else {
            $_SESSION['msg'] = 'There were some problems on the server! Please try again later.';
            header('location: ../../staff/food-list.php');
        }
    } else {
        
        $_SESSION['msg'] = 'Image upload failed!';
        header('location: ../../staff/food-list.php');
        exit();
    }
}
?>
