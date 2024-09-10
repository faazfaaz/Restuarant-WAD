<!-- offers-list.php -->

<?php
require('layout/header.php');
require('layout/left-sidebar-long.php');
require('layout/topnav.php');
require('layout/left-sidebar-short.php');

// Include the database connection file
require_once('../backends/connection-pdo.php');

?>

<div class="section white-text" style="background: #B35458;">

    <div class="section">
        <h3>Offers List</h3>
    </div>

    <div class="section center" style="padding: 40px;">

        <?php
        // Fetch offers from the database
        $offer_query = $pdoconn->query("SELECT * FROM offers");
        ?>

        <table class="striped">
            <thead>
                <tr>
                    <th>Offer Title</th>
                    <th>Offer Description</th>
                    <th>Offer Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($offer = $offer_query->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $offer['offer_title']; ?></td>
                        <td><?php echo $offer['offer_description']; ?></td>
                        <td><img src="/TheOuterClove/images/<?php echo $offer['offer_image']; ?>" alt="<?php echo $offer['offer_title']; ?>" style="max-width: 100px;"></td>
                        <td>
                        
                        <a href="../backends/admin/offer-delete.php?id=<?php echo $offer['offer_id']; ?>" class="waves-effect waves-light btn red">
    Delete
</a>


                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="section" style="padding-top: 20px;">
            <a href="offer-add-form.php" class="waves-effect waves-light btn green">Add Offer</a>
        </div>

    </div>

</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>