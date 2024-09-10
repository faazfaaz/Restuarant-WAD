<?php
require('layout/header.php');
require('layout/left-sidebar-long.php');
require('layout/topnav.php');
require('layout/left-sidebar-short.php');
require('../backends/config.php');
require('../backends/connection-pdo.php');

$sql = 'SELECT id, staff_name, position, age, email, gender, address, phone, password
        FROM staff';

$query  = $pdoconn->prepare($sql);
if (!$query) {
    die('Error in query preparation.');
}
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="section white-text" style="background: #B35458;">
    <div class="section">
        <h3>Staff Members</h3>
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

    <div class="section right" style="padding: 15px 25px;">
        <a href="staff-add.php" class="waves-effect waves-light btn">Add New Staff</a>
    </div>

    <div class="section center" style="padding: 20px;">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Password</th>
                    
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Action</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($arr_all as $key) : ?>
                    <tr>
                        <td><?php echo $key['staff_name']; ?></td>
                        <td><?php echo $key['position']; ?></td>
                        <td><?php echo $key['age']; ?></td>
                        <td><?php echo $key['email']; ?></td>
                        <td><?php echo $key['password']; ?></td>
                        
                        <td><?php echo $key['address']; ?></td>
                        <td><?php echo $key['phone']; ?></td>
                        <td>
                            <a href="../backends/admin/staff-delete.php?id=<?php echo $key['id']; ?>">
                                <span class="new badge" data-badge-caption="">Delete</span>
                            </a>
                        </td>
                        <td>
                            <a href="staff-edit-form.php?id=<?php echo $key['id']; ?>" class="waves-effect waves-light btn">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>
