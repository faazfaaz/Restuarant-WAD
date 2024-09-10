<!-- offer-add-form.php -->

<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>

<div class="section white-text" style="background: #B35458;">

    <div class="section">
        <h3>Add New Offer</h3>
    </div>

    <div class="section center" style="padding: 40px;">

        <form action="../backends/admin/offer-add.php" method="post" enctype="multipart/form-data">

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
                        <input id="offer_title" name="offer_title" type="text" class="validate" style="color: white; width: 70%">
                        <label for="offer_title" style="color: white;"><b>Offer Title:</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <textarea id="offer_description" name="offer_description" class="materialize-textarea validate" style="color: white; width: 70%"></textarea>
                        <label for="offer_description" style="color: white;"><b>Offer Description:</b></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Upload Image</span>
                            <input type="file" name="offer_image">
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
                        <a href="offers-list.php" class="waves-effect waves-light btn">Dismiss</a>
                    </div>
                    <div class="section right" style="padding: 15px 20px;">
                        <button type="submit" class="waves-effect waves-light btn">Add New Offer</button>
                    </div>
                </div>
            </div>

        </form>

    </div>

</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>
