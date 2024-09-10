<?php
require('layout/header.php');
require('layout/left-sidebar-long.php');
require('layout/topnav.php');
require('layout/left-sidebar-short.php');
require('../backends/config.php');
require('../backends/connection-pdo.php');

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to staff-list.php if ID is missing
    header('location: staff-list.php');
    exit();
}

$staffId = $_GET['id'];

// Fetch details of the selected staff member
$selectSql = 'SELECT id, staff_name, position, age, email, password, gender, address, phone FROM staff WHERE id = ?';
$selectQuery = $pdoconn->prepare($selectSql);
$selectQuery->execute([$staffId]);
$staffDetails = $selectQuery->fetch(PDO::FETCH_ASSOC);
?>

<div class="section white-text" style="background: #B35458;">
    <div class="section">
        <h3>Edit Staff Member</h3>
    </div>

    <div class="section center" style="padding: 40px;">
        <form action="../backends/admin/staff-edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $staffId; ?>">

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="name" name="name" type="text" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['staff_name']; ?>">
                        <label for="name" style="color: white;"><b>Staff Name :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="position" name="position" type="text" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['position']; ?>">
                        <label for="position" style="color: white;"><b>Position :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="email" name="email" type="email" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['email']; ?>">
                        <label for="email" style="color: white;"><b>Email :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="password" name="password" type="password" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['password']; ?>">
                        <label for="password" style="color: white;"><b>Password :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Include fields for other details (age, gender, address, phone) -->

                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="address" name="address" type="text" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['address']; ?>">
                        <label for="address" style="color: white;"><b>Address :</b></label>
                    </div>
                </div>

                <div class="col s6">
                    <div class="input-field">
                        <input id="phone" name="phone" type="tel" class="validate" style="color: white; width: 70%" value="<?php echo $staffDetails['phone']; ?>">
                        <label for="phone" style="color: white;"><b>Phone Number :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="section right" style="padding: 15px 10px;">
                        <a href="staff-list.php" class="waves-effect waves-light btn">Dismiss</a>
                    </div>
                    <div class="section right" style="padding: 15px 20px;">
                        <button type="submit" class="waves-effect waves-light btn">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require('layout/footer.php'); ?>
