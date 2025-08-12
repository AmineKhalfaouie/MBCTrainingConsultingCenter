<?php
$newsletter_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-favorites-submit'])){
        $deletedrecord = $favorite->deleteFavorites($_POST['item_id']);
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
<!-- favorites section  -->
<section id="favorites" class="py-3">
    <?php echo $newsletter_message; ?>
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Favorites</h5>
        <!--  favorites items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                    if($offer->getdata('favorites') == null) {
                        echo '<i class="fas fa-box-open" style="font-size:200px;text-align: center; justify-content: center;text-center: center;margin-left: 15%;"></i>';
                    } else {
                        foreach ($offer->getData('favorites') as $item) :
                            $favorites = $offer->getOfferById($item['item_id'], $_SESSION['user_id']);
                            $subTotal[] = array_map(function ($item){
                            ?>
                            <!-- favorite item -->
                            <div class="favorite row border-top py-3 mt-3">
                                <div class="col-sm-2">
                                    <img src="<?php echo $item['item_image'] ?? './images/offers/job offers qatar.jpg'; ?>" style="height: 150px;" alt="cart1" class="img-fluid">
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? 'Unknown'; ?></h5>
                                    <small>by abc agence</small>
                                    <!-- product rating -->
                                    <div class="d-flex">
                                        <div class="rating text-warning font-size-12">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="far fa-star"></i></span>
                                        </div>
                                        <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                                    </div>
                                    <!--  !product rating-->
                                    <h6 class="font-baloo font-size-14 mt-2">SubDescription</h6>
                                    <p class="font-baloo font-size-14"><?php echo $item['item_subdescription'] ?? 'Unknown'; ?></p>
                                </div>

                                <div class="col-sm-2 text-right">
                                    <div class="font-size-20 text-danger font-baloo">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                            <button type="submit" name="delete-favorites-submit" class="btn btn-delete font-baloo text-danger px-3 border-right">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- !favorite item -->
                        <?php
                                }, $favorites); // closing array_map function
                        endforeach;
                    }
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i>Click on proced to apply to sent your.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal (<?php echo count($offer->getData('favorites')); ?> item)&nbsp;</h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Apply</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  favorites items   -->
    </div>
</section>
<!-- favorites section  -->