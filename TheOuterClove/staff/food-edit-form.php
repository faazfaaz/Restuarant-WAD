<?php
// food-edit-form.php

require('layout/header.php');
require('layout/left-sidebar-long.php');
require('layout/topnav.php');
require('layout/left-sidebar-short.php');
require('../backends/config.php');
require('../backends/connection-pdo.php');

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to food-list.php if ID is missing
    header('location: food-list.php');
    exit();
}

$foodId = $_GET['id'];

// Fetch details of the selected food item
$selectSql = 'SELECT id, fname, description, price, cat_id FROM food WHERE id = ?';
$selectQuery = $pdoconn->prepare($selectSql);
$selectQuery->execute([$foodId]);
$foodDetails = $selectQuery->fetch(PDO::FETCH_ASSOC);

// Fetch all categories for the dropdown
$categorySql = 'SELECT id, name FROM categories';
$categoryQuery = $pdoconn->prepare($categorySql);
$categoryQuery->execute();
$categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="section white-text" style="background: #B35458;">
    <div class="section">
        <h3>Edit Food Item</h3>
    </div>

    <div class="section center" style="padding: 40px;">
        <form action="../backends/admin/food-edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $foodId; ?>">

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="name" name="name" type="text" class="validate" style="color: white; width: 70%" value="<?php echo $foodDetails['fname']; ?>">
                        <label for="name" style="color: white;"><b>Food Name :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 90%">
                        <select name='category'>
                            <?php
                            $selectedCategoryId = $foodDetails['cat_id'];
                            foreach ($categories as $category) {
                                $selected = ($category['id'] == $selectedCategoryId) ? 'selected' : '';
                                echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <label style="color: white;">Categories</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <input id="desc" name="desc" type="text" class="validate" style="color: white; width: 70%" value="<?php echo $foodDetails['description']; ?>">
                        <label for="desc" style="color: white;"><b>Description :</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <input id="price" name="price" type="number" class="validate" style="color: white; width: 70%" value="<?php echo $foodDetails['price']; ?>">
                        <label for="price" style="color: white;"><b>Price (Rs.):</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Image</span>
                            <input type="file" name="food_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="section right" style="padding: 15px 10px;">
                        <a href="staff/food-list.php" class="waves-effect waves-light btn">Dismiss</a>
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
