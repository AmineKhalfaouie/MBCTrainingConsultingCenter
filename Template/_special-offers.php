<?php
    $category = array_map(function($item) { return $item['item_category'];}, $offer_shuffle);
    $unique_category = array_unique($category);
    sort($unique_category);
    shuffle($offer_shuffle);

    // call method addToFavorites
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['special-offer-submit'])) {
            $favorite->addToFavorites($_POST['user_id'], $_POST['item_id']);
        }
    }
    $in_favorites = $favorite->getFavoritesById($offer->getData('favorites')) ?? [];
?>
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
<!-- special offers section -->
<section id="special-offers">
    <div class="container">
        <h4 class="font-size-20 font-rubik">Special Offers</h4>
        <div id="filters" class="button-group text-end">
            <button class="btn" style="font-weight: 700;" data-filter="">AllOffers</button>
            <?php
                array_map(function($item) {
                printf('<button class="btn" data-filter=".%s">%s</button>', $item, $item);
            }, $unique_category); ?>
        <div class="grid">
            <?php array_map(function($item) use ($in_favorites){ ?>
            <div class="grid-item <?php echo $item['item_category'] ?? 'Category'; ?> border">
                <div class="item p-4">
                    <div class="offer font-rale">
                        <a href="<?php printf('offer.php?item_id=%d', $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? './images/offers/job offers qatar.jpg'; ?>" style="width: 200px;height: 250px;" alt="offer1"></a>
                        <div class="text-center">
                            <h6><?php echo $item['item_name'] ?? 'Unknown'; ?></h6>
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
                                    if (in_array($item['item_id'], $in_favorites)) {
                                        echo '<button type="submit" disabled class="btn btn-warning font-size-12 mt-2" name="special-offer-submit">In Favorites</button>';
                                    } else {
                                        echo '<button type="submit" class="btn btn-warning font-size-12 mt-2" name="special-offer-submit">Submit</button>';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }, $offer_shuffle); ?>
        </div>
    </div>
</section>
<!-- special offers section -->
<?php endif; ?>