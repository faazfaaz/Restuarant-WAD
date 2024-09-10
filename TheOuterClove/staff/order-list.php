<?php
require('../backends/connection-pdo.php');


if (isset($_GET['delete_order_id'])) {
    $delete_order_id = $_GET['delete_order_id'];

    
    $delete_sql = 'DELETE FROM orders WHERE order_id = ?';
    $delete_query = $pdoconn->prepare($delete_sql);
    $delete_result = $delete_query->execute([$delete_order_id]);

    
    header('Location: order-list.php');
    exit();
}


$sql = 'SELECT orders.order_id, orders.user_name, orders.timestamp, food.fname FROM orders LEFT JOIN food ON orders.food_id = food.id';
$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>

<div class="section white-text" style="background: #B35458;">
    <div class="section">
        <h3>Orders</h3>
    </div>

    <?php
    if (isset($_SESSION['msg'])) {
        echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: red; color: white;">
        <div class="col s12">
            <h6>'.$_SESSION['msg'].'</h6>
            </div>
        </div></div>';
        unset($_SESSION['msg']);
    }
    ?>

    <div class="section center" style="padding: 20px;">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($arr_all as $key): ?>
                    <tr>
                        <td><?php echo $key['order_id']; ?></td>
                        <td><?php echo $key['user_name']; ?></td>
                        <td><?php echo $key['timestamp']; ?></td>
                        <td>
                            <a href="?delete_order_id=<?php echo $key['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>
