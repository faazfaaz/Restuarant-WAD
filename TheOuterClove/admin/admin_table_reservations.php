<?php

$dbHost = "localhost";
$dbUser = "Fayaz";
$dbPassword = "12345";
$dbName = "mishtidb";


$isAdmin = true;

if ($isAdmin) {
    
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM reservations";
    $result = $conn->query($sql);

    
    ?>
    <?php require('layout/header.php'); ?>
    <?php require('layout/left-sidebar-long.php'); ?>
    <?php require('layout/topnav.php'); ?>
    <?php require('layout/left-sidebar-short.php'); ?>
    <div class="section white-text" style="background: #B35458;">
        <div class="section">
            <h3>Table Reservations</h3>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                ?>
                <div class="section center" style="padding: 20px;">
                    <table class="centered responsive-table">
                        <thead>
                        <tr>
                            <th>Table Number</th>
                            <th>Reservation Date</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Party Size</th>
                            <th>Special Requests</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $row["table_number"]; ?></td>
                            <td><?php echo $row["reservation_date"]; ?></td>
                            <td><?php echo $row["user_name"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["phone"]; ?></td>
                            <td><?php echo $row["party_size"]; ?></td>
                            <td><?php echo $row["special_requests"]; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        } else {
            echo "No reserved tables.";
        }
        
        $conn->close();
        ?>
    </div>
    <?php require('layout/about-modal.php'); ?>
    <?php require('layout/footer.php'); ?>
    <?php
} else {
    
    echo "Access denied. You are not authorized to view this page.";
}
?>
