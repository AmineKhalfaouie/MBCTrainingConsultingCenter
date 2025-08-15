<!-- top offers section -->
<?php
$offer_shuffle = $offer->getData();
shuffle($offer_shuffle);
// call method addToFavorites
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['top-offer-submit'])) {
        $favorite->addToFavorites($_POST['user_id'], $_POST['item_id']);
    }
}
?>
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
<div id="top-offers">
    <div class="container py-5">
        <h4 class="font-size-20 font-rubik">Top Offers</h4>
        <hr>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach($offer_shuffle as $item) { ?>
            <div class="item py-2 text-center">
                <div class="offer font-rale">
                    <a href="<?php printf('offer.php?item_id=%d', $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? './images/offers/job offers france.jpg'; ?>" alt="offer1" class="img-fluid" style="width:200px;height:250px;"></a>
                    <div>
                        <h6><?php echo $item['item_name'] ?? 'Unknown Offer'; ?></h6>
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 0; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? 1; ?>">
                            <?php
                                if (in_array($item['item_id'], $favorite->getFavoritesById($offer->getData('favorites')) ?? [])) {
                                    echo '<button type="submit" disabled class="btn btn-warning font-size-12 mt-2" name="top-offer-submit">In Favorites</button>';
                                } else {
                                    echo '<button type="submit" class="btn btn-warning font-size-12 mt-2" name="top-offer-submit">Submit</button>';
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- owl carousel -->
    </div>
</div>
<?php endif; ?>
<!-- top offers section -->