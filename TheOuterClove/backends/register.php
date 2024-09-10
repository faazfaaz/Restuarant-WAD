<?php
try {
    if (!file_exists('connection-pdo.php')) {
        throw new Exception();
    } else {
        require_once('connection-pdo.php');
    }
} catch (Exception $e) {
    $arr = array('code' => "0", 'msg' => "There were some problems in the Server! Try after some time!");
    echo json_encode($arr);
    exit();
}

if (
    !isset($_POST['name']) || !isset($_POST['address']) ||  
    !isset($_POST['contact']) || !isset($_POST['email']) || !isset($_POST['password'])
) {
    $arr = array('code' => "0", 'msg' => "Invalid POST variable keys! Refresh the page!");
    echo json_encode($arr);
    exit();
}

$regex_email = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
$regex_name = '/^[A-Za-z0-9\s]+$/';
$regex_password = '/^[A-Za-z0-9!@#?-_%]+$/';
$regex_contact = '/^[0-9]+$/';

if (
    empty($_POST['name']) ||
    empty($_POST['address']) ||
    empty($_POST['contact']) ||
    empty($_POST['email']) ||
    empty($_POST['password'])
) {
    $arr = array('code' => "0", 'msg' => "Please fill in all the fields!");
    echo json_encode($arr);
    exit();
}

if (
    !preg_match($regex_name, $_POST['name']) ||
    !preg_match($regex_name, $_POST['address']) ||
    !preg_match($regex_contact, $_POST['contact']) ||
    !preg_match($regex_email, $_POST['email']) ||
    !preg_match($regex_password, $_POST['password'])
) {
    $arr = array('code' => "0", 'msg' => "Whoa! Invalid Inputs!");
    echo json_encode($arr);
    exit();
} else {
    date_default_timezone_set("Asia/Kolkata");
    $email = $_POST['email'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $timest = date("Y-m-d H:i:s");

    try {
        $sql = "SELECT * FROM users WHERE email=?";
        $query = $pdoconn->prepare($sql);
        $query->execute([$email]);
        $arr_login = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($arr_login) != 0) {
            $arr = array('code' => "0", 'msg' => "Duplicate entry found! Try registering with a different email id!");
            echo json_encode($arr);
            exit();
        } else {
            $sql = "INSERT INTO users(name, address, contact, email, password, timestamp) VALUES(:name, :address, :contact, :email, :password, :timestamp)";
            
            $query = $pdoconn->prepare($sql);
            if ($query->execute([
                ':name' => $name,
                ':address' => $address,
                ':contact' => $contact,
                ':email' => $email,
                ':password' => $password,
                ':timestamp' => $timest
            ])) {
                $arr = array('code' => "1", 'msg' => "You have been registered! Please go to the Login option for logging in!");
                echo json_encode($arr);
            } else {
                $arr = array('code' => "0", 'msg' => "There were some problems in the server! Please try again after some time!");
                echo json_encode($arr);
                var_dump($query->errorInfo()); // Display SQL errors
            }
        }
    } catch (PDOException $e) {
        $arr = array('code' => "0", 'msg' => "Database error: " . $e->getMessage());
        echo json_encode($arr);
    }
}
?>
