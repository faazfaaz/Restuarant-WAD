<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>

<?php
require('../backends/connection-pdo.php');
?>

<div class="section white-text" style="background: #B35458;">

    <div class="section">
        <h3>Add Staff Member</h3>
    </div>

    <div class="section center" style="padding: 40px;">

        <form action="../backends/admin/staff-add.php" method="post">

            <?php
            if (isset($_SESSION['msg'])) {
                echo '<div class="row" style="background: red; color: white;">
                <div class="col s12">
                    <h6>'.$_SESSION['msg'].'</h6>
                    </div>
                </div>';
                unset($_SESSION['msg']);
            }
            ?>

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="name" name="name" type="text" class="validate" style="color: white; width: 70%">
                        <label for="name" style="color: white;"><b>Staff Name :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="position" name="position" type="text" class="validate" style="color: white; width: 70%">
                        <label for="position" style="color: white;"><b>Position :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="age" name="age" type="number" class="validate" style="color: white; width: 70%">
                        <label for="age" style="color: white;"><b>Age :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="email" name="email" type="email" class="validate" style="color: white; width: 70%">
                        <label for="email" style="color: white;"><b>Email :</b></label>
                    </div>
                </div>
            </div>

            <!-- New Password Field -->
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="password" name="password" type="password" class="validate" style="color: white; width: 70%">
                        <label for="password" style="color: white;"><b>Password :</b></label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <label style="color: white;"><b>Gender :</b></label>
                        <p>
                            <label>
                                <input name="gender" type="radio" value="male" />
                                <span style="color: white;">Male</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="gender" type="radio" value="female" />
                                <span style="color: white;">Female</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <input id="address" name="address" type="text" class="validate" style="color: white; width: 70%">
                        <label for="address" style="color: white;"><b>Address :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="phone" name="phone" type="tel" class="validate" style="color: white; width: 70%">
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
                        <button type="submit" class="waves-effect waves-light btn">Add New</button>
                    </div>
                </div>
            </div>

        </form>

    </div>

</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>
