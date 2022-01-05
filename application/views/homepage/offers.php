<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
    <p class="m-text13 t-center">
        Doa Ibu Coffee
    </p>
</section>
<!-- Banner Promo -->
<section class="banner2 bg5 p-t-45 p-b-45">
    <?php if ($offers != null) { ?>
        <div class="container">
            <div class="wrap-slick4">
                <div class="slick4">
                    <?php
                    foreach ($offers as $off) :
                        $date = date('d-M-Y', strtotime($off['expired']));
                    ?>
                        <div class="item-slick4 p-l-15 p-r-15">
                            <div class="bgwhite hov-img-zoom pos-relative">
                                <img src="<?= base_url('assets/img/') ?>offers/<?= $off['image']; ?>" alt="IMG-OFFERS">
                                <div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
                                    <div class="offers">
                                        <div class="flex-col-c-m bo1 bg4 p-l-5 -r-5">
                                            <span class="m-text9 fs-20-sm">
                                                <?= $off['name']; ?>
                                            </span>
                                        </div>
                                        <p class="s-text27">
                                            <?= $off['description']; ?>
                                        </p>
                                        <p class="s-text27  ">
                                            <?= $off['information']; ?>
                                        </p>
                                    </div>
                                    <div class="flex-c-m p-t-44 p-t-30-xl">
                                        <div class="flex-col-c-m bg11 m-l-5 m-r-5 p-2">
                                            <span class="m-text28 p-b-1">
                                                Expired : <?= $date; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="header-footer">
            <div class="container">
                <div class="py-4 align-items-center">
                    <div class="text-center mb-md-0">
                        <h6 class="mb-0">There are no offers for today</h6>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
<!-- Product -->
<section class="bgwhite product-home p-t-55 p-b-10">
    <div class="container container-product">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Promo-DOI
            </h3>
        </div>
        <div class="row">
            <?php foreach ($productoffers as $pof) :
                $price = $pof->price;
                $discount = $pof->current_discount;
                $total_discount = ($discount / 100) * $price;
                $fixed_price = $price - $total_discount;
            ?>
                <div class="col-sm-6 col-md-6 col-lg-3 col-6 p-b-20">
                    <div class="bo9 bo-rad-5 block2" style="background-color: #FAAF40;">
                        <?php if ($pof->stock_product == 'Sold-Out') { ?>
                            <div class="overlay"></div>
                            <div class="ribbon1">
                                <div class="ribbon1-content">
                                    <div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $pof->stock_product !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
                            <a href="<?= base_url('products/detail/' . $pof->id); ?>" class="block3-img dis-block hov-img-zoom">
                                <img src="<?= base_url('assets/img/') ?>product/<?= $pof->product_image; ?>" alt="<?= $pof->product_name; ?>">
                            </a>
                            <?php if ($pof->stock_product !== 'Sold-Out') { ?>
                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>
                                    <div class="block2-btn-addcart w-size29 trans-0-4">
                                        <div class="add_qty_cart flex-w of-hidden">
                                            <button class="btn-num-product-down btn-qty color1 flex-c-m bg8 eff2">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="qty-num-product m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $pof->id; ?>">
                                            <button class="btn-num-product-up btn-qty color1 flex-c-m bg8 eff2">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <button class="add-cart add_to_cart flex-c-m hov1 s-text21 trans-0-4" data-productid="<?= $pof->id; ?>" data-productname="<?= $pof->product_name; ?>" data-productprice="<?= $fixed_price; ?>" data-producttime="<?= $pof->bursttime; ?>" data-action="add">
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
                                <a href="<?= base_url('homepage/detail/' . $pof->id); ?>" class="block2-product-name">
                                    <?= $pof->product_name ?>
                                </a>
                            </h4>
                            <span class="block2-oldprice">
                                RP <?= number_format($price, '0', ',', '.') ?>
                            </span>
                            <span class="block2-newprice">
                                RP <?= number_format($fixed_price, '0', ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>