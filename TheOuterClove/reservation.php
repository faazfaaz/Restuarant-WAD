<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table Reservation - The Outer Clove</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require('chunks/login-modal.php'); ?>
    <?php require('chunks/register-modal.php'); ?>
    <?php require('chunks/info-modal.php'); ?>
    <?php require('chunks/navbar.php'); ?>

    <div class="section" style="background: white; padding: 20px;">

        <div class="section">
            <h3 class="center-align">Table Reservation</h3>
        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo '<div class="section center" style="margin: 5px 35px;"><div class="row red white-text">
            <div class="col s12">
                <h6>'.$_SESSION['msg'].'</h6>
                </div>
            </div></div>';
            unset($_SESSION['msg']);
        }
        ?>

        <div class="section">
            <form action="backends/reserve-table.php" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="table_number" type="number" name="table_number" required>
                        <label for="table_number">Table Number</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="reservation_date" type="datetime-local" name="reservation_date" required>
                        <label for="reservation_date"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" name="name" required>
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" required>
                        <label for="email">Email Address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="phone" type="tel" name="phone" required>
                        <label for="phone">Phone Number</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="party_size" type="number" name="party_size" required>
                        <label for="party_size">Party Size</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="special_requests" name="special_requests" class="materialize-textarea"></textarea>
                        <label for="special_requests">Special Requests</label>
                    </div>
                </div>

                <div class="row center-align">
                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn" style="background: #1D6E95 !important;">Reserve Table</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php  ?>


    <?php require('chunks/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/loaders.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>
