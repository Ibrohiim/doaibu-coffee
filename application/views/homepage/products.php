<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
    <p class="m-text13 t-center">
        Menu Doa Ibu Coffee
    </p>
</section>

<!-- Content page -->
<section class="bgwhite product-home p-t-55 p-b-10">
    <div class="container container-product">
        <!-- Product -->
        <div class="row">
            <?php foreach ($product as $pro) :
                $price = $pro->price;
                $discount = $pro->current_discount;
                $total_discount = ($discount / 100) * $price;
                $fixed_price = $price - $total_discount;
            ?>
                <div class="col-sm-6 col-md-6 col-lg-3 col-6 p-b-20">
                    <div class="bo9 bo-rad-5 block2" style="background-color: #FAAF40;">
                        <?php if ($pro->stock_product == 'Sold-Out') { ?>
                            <div class="overlay"></div>
                            <div class="ribbon1">
                                <div class="ribbon1-content">
                                    <div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $pro->stock_product !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
                            <a href="<?= base_url('homepage/detail/' . $pro->id); ?>" class="block3-img dis-block hov-img-zoom">
                                <img src="<?= base_url('assets/img/') ?>product/<?= $pro->product_image; ?>" alt="<?= $pro->product_name; ?>">
                            </a>
                            <?php if ($pro->stock_product !== 'Sold-Out') { ?>
                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>
                                    <div class="block2-btn-addcart w-size30 trans-0-4">
                                        <div class="add_qty_cart flex-w of-hidden">
                                            <button class="btn-num-product-down btn-qty color1 flex-c-m bg8 eff4">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="qty-num-product m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $pro->id; ?>">
                                            <button class="btn-num-product-up btn-qty color1 flex-c-m bg8 eff4">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <button class="add-cart add_to_cart flex-c-m hov7 s-text26 trans-0-4" data-productid="<?= $pro->id; ?>" data-productname="<?= $pro->product_name; ?>" data-productprice="<?= $fixed_price; ?>" data-producttime="<?= $pro->bursttime; ?>" data-action="add">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="block2-btn-notavailable trans-0-4">
                                    <button class="btn_notavailable flex-c-m s-text21 trans-0-4" disabled>
                                        Item Not Available
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="block3-txt p-b-10 text-center bo-rad-5">
                            <h4>
                                <a href="<?= base_url('homepage/detail/' . $pro->id); ?>" class="block2-product-name">
                                    <?= $pro->product_name ?>
                                </a>
                            </h4>
                            <?php if ($discount !== '0') { ?>
                                <span class="block2-oldprice">
                                    RP <?= number_format($price, '0', ',', '.') ?>
                                </span>
                                <span class="block2-newprice">
                                    RP <?= number_format($fixed_price, '0', ',', '.') ?>
                                </span>
                            <?php } else { ?>
                                <span class="block2-product-price">
                                    RP <?= number_format($fixed_price, '0', ',', '.') ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>