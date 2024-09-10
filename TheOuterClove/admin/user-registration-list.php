<?php
require('layout/header.php');
require('layout/left-sidebar-long.php');
require('layout/topnav.php');
require('layout/left-sidebar-short.php');
require('../backends/config.php');
require('../backends/connection-pdo.php');

try {
    
    $sql = "SELECT * FROM users";
    $query = $pdoconn->query($sql);
    $userList = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<div class="section white-text" style="background: #B35458;">
    <div class="section">
        <h3>User Registration List</h3>
    </div>

    <?php
    if (isset($_SESSION['msg'])) {
        echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: red; color: white;">
        <div class="col s12">
            <h6>' . $_SESSION['msg'] . '</h6>
            </div>
        </div></div>';
        unset($_SESSION['msg']);
    }
    ?>

   

    <div class="section center" style="padding: 20px;">
        <?php if (isset($userList) && count($userList) > 0): ?>
            <table class="centered responsive-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Timestamp</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userList as $user): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['contact']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['timestamp']; ?></td>
                            <td>
                               
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
    </div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>
+