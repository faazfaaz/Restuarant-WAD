<!-- banner-slider.php -->

<section class="fslider">
    <div class="slider">
        <ul class="slides">
            <?php
            // Include the database connection file using __DIR__
            require_once(__DIR__ . '/../backends/connection-pdo.php');

            // Fetch offers from the database
            $offer_query = $pdoconn->query("SELECT * FROM offers");

            while ($offer = $offer_query->fetch(PDO::FETCH_ASSOC)) {
                echo '<li>
				<img src="/TheOuterClove/images/' . $offer['offer_image'] . '">

                          <div class="caption center-align black-text">  
                              <h3 style="font-size: 3rem !important; font-style: bold !important; font-family: \'Bree Serif\', serif;">' . $offer['offer_title'] . '</h3>  
                              <h5 class="light black-text text-lighten-3"><strong>' . $offer['offer_description'] . '</strong></h5>  
                          </div>  
                        </li>';
            }
            ?>
        </ul>
    </div>
</section>
