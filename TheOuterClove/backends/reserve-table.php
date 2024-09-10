<?php
session_start();

try {
    require_once('connection-pdo.php');
} catch (Exception $e) {
    $arr = array('code' => "0", 'msg' => "There were some problems on the server! Try again later.");
    echo json_encode($arr);
    exit();
}

if (!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You must log in first to reserve a table!";
    header('location: ../reservation.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
    $table_number = $_POST['table_number'];
    $reservation_date = $_POST['reservation_date'];
    
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $party_size = $_POST['party_size'];
    $special_requests = $_POST['special_requests'];

    // Check if the seat is available
    $sql_check_availability = "SELECT * FROM reservations WHERE table_number = ? AND reservation_date = ?";
    $query_check_availability = $pdoconn->prepare($sql_check_availability);

    if ($query_check_availability->execute([$table_number, $reservation_date]) && $query_check_availability->rowCount() > 0) {
        $_SESSION['msg'] = 'Sorry, the seat is not available at this moment. Please choose another time or table.';
        header('location: ../reservation.php');
        exit();
    }

    // Proceed with the reservation
    $sql = "INSERT INTO reservations (user_name, user_id, table_number, reservation_date, name, email, phone, party_size, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $query = $pdoconn->prepare($sql);

    if ($query->execute([$user_name, $user_id, $table_number, $reservation_date, $name, $email, $phone, $party_size, $special_requests])) {
        $_SESSION['msg'] = 'Table reserved successfully!';
        header('location: ../reservation.php');
    } else {
        $_SESSION['msg'] = 'There were some problems on the server! Please try again later.';
        header('location: ../reservation.php');
    }
} else {
    $_SESSION['msg'] = 'Invalid request!';
    header('location: ../reservation.php');
}
