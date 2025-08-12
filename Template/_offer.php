<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_to_favorites'])) {
            $favorite->addToFavorites($_POST['user_id'], $_POST['item_id']);
        }
        if (isset($_POST['subscribe-submit'])) {
            $email = $_POST['subscribe-email'];
            if ($newsletter->subscribe($email)) {
                $newsletter_message = '<div class="alert alert-success fade-in-alert newsletter-alert" role="alert">A simple success alert—check it out!</div>';
            } else {
                $newsletter_message = '<div class="alert alert-danger fade-in-alert newsletter-alert" role="alert">Subscription failed. Please try again.</div>';
            }
        }
    }
?>
<!-- offer section -->
<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo $item['item_image']; ?>" alt="product" style="width: 100%; height: 550px;">
                <div class="row font-size-16 font-baloo pt-4">
                    <div class="col">
                        <button type="submit" class="btn btn-danger form-control">Proceed To Submit</button>
                    </div>
                    <div class="col">
                        <form method="POST">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 0; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? 1; ?>">
                            <?php
                                if (in_array($item['item_id'], $favorite->getFavoritesById($offer->getData('favorites')) ?? [])) {
                                    echo '<button type="submit" disabled class="btn btn-warning form-control">In Favorites</button>';
                                }
                                else {
                                    echo '<button type="submit" name="add_to_favorites" class="btn btn-warning form-control">Add To favorites</button>';
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-5">
                <h5 class="font-baloo font-size-20"><?php echo $item['item_name']; ?></h5>
                <small>By agency abc</small>
                <div class="d-flex">
                    <div class="rating text-warning font-size-12">
                        <span><i class="bi bi-star-fill"></i></span>
                        <span><i class="bi bi-star-fill"></i></span>
                        <span><i class="bi bi-star-fill"></i></span>
                        <span><i class="bi bi-star-fill"></i></span>
                        <span><i class="bi bi-star-half"></i></span>
                    </div>
                </div>
                <a href="#" class="px-2 font-size-14 font-rale" style="text-decoration: none;">20.654 ratings | 1000+ answerd questions</a>
                <hr>
                <h6 class="font-rubik">Offer Description:</h6>
                <p class="font-rale font-size-14"><?php echo $item['item_description'] ?? 'No description available'; ?></p>
            </div>
        </div>
    </div>
</section>
