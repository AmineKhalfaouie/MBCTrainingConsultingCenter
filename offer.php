<?php
ob_start();
//include headher.php file
include('header.php');
//include Template/headher.php file

// Get the item ID from the URL and fetch the corresponding item
$item_id = $_GET['item_id'] ?? 1;
foreach ($offer->getData() as $item):
    if($item['item_id'] == $item_id):
        include('Template/_header-offer.php');
        //include _offer.php file
        include('Template/_offer.php');
endif;
endforeach;

//include _top-offers.php file
include('Template/_top-offers.php');
//include _newsletter.php file
include('Template/_newsletter.php');
//include footer.php file
include('footer.php');
?>
<!-- offer section -->
