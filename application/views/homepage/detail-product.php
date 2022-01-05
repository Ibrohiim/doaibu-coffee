<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-10 p-l-15-sm">
    <a href="<?= base_url('frontpage'); ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?= base_url('homepage/products'); ?>" class="s-text16">
        Products
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        <?= $title; ?>
    </span>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-20 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>
                <div class="slick3">
                    <div class="item-slick3" data-thumb="<?= base_url('assets/img/') ?>product/<?= $product->product_image ?>">
                        <div class="wrap-pic-w">
                            <img src="<?= base_url('assets/img/') ?>product/<?= $product->product_image ?>" alt="<?= $product->product_name; ?>">
                        </div>
                    </div>
                    <?php
                    if ($image) {
                        foreach ($image as $img) {
                    ?>
                            <div class="item-slick3" data-thumb="<?= base_url('assets/img/') ?>product/thumbs/<?= $img->image ?>">
                                <div class="wrap-pic-w">
                                    <img src="<?= base_url('assets/img/') ?>product/thumbs/<?= $img->image ?>" alt="<?= $img->image_name; ?>">
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $price = $product->price;
        $discount = $product->current_discount;
        $total_discount = ($discount / 100) * $price;
        $fixed_price = $price - $total_discount;
        ?>
        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text20 p-b-5">
                <?= $title; ?>
            </h4>
            <?php if ($discount !== '0') { ?>
                <span class="block2-oldprice m-text7 p-r-5">
                    RP <?= number_format($price, '0', ',', '.') ?>
                </span>
                <span class="block2-newprice m-text8 p-r-5">
                    RP <?= number_format($fixed_price, '0', ',', '.') ?>
                </span>
            <?php } else { ?>
                <span class="s-text-15">
                    RP <?= number_format($fixed_price, '0', ',', '.') ?>
                </span>
            <?php } ?>
            <p class="s-text8 p-t-5">
                <?= $product->description ?>
            </p>
            <div class="p-t-33 p-b-60">
                <div class="flex-m flex-w p-b-10">
                    <div class="s-text15 w-size15 t-center">
                        Size
                    </div>
                    <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                        <select class="selection-2" name="size">
                            <option>Choose an option</option>
                            <option>Size S</option>
                            <option>Size M</option>
                            <option>Size L</option>
                            <option>Size XL</option>
                        </select>
                    </div>
                </div>
                <div class="flex-r-m flex-w p-t-10">
                    <?php if ($product->stock_product !== 'Sold-Out') { ?>
                        <div class="block2-btn-addcart-detail w-size16 flex-m">
                            <div class="add_qty_cart_detail flex-w of-hidden">
                                <button class="btn-num-product-down btn-qty-detail color1 flex-c-m bg8 eff4">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input class="qty-num-product-detail m-text18 t-center num-product" type="number" name="qty" value="1" id="<?= $product->id; ?>">
                                <button class="btn-num-product-up btn-qty-detail color1 flex-c-m bg8 eff4">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button class="add-cart add_to_cart_detail flex-c-m sizefull hov7 s-text26 trans-0-4" data-productid="<?= $product->id; ?>" data-productname="<?= $product->product_name; ?>" data-productprice="<?= $fixed_price; ?>" data-producttime="<?= $product->bursttime; ?>" data-action="add">
                                Add to Cart
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="w-size16 flex-m flex-w">
                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <button class="btn_notavailable flex-c-m size26 bg11 bo-rad-10 s-text21 trans-0-4" disabled>
                                    Item Not Available
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-20 p-b-100">
    <div class="container">
        <div class="sec-title p-b-40">
            <h3 class="m-text5 t-center">
                Related Products
            </h3>
        </div>
        <div class="wrap-slick2">
            <div class="slick2">
                <?php foreach ($product_related as $pr) {
                    $price = $pr->price;
                    $discount = $pr->current_discount;
                    $total_discount = ($discount / 100) * $price;
                    $fixed_price = $price - $total_discount;
                ?>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="bo9 bo-rad-5 block2 pos-relative" style="background-color: #FAAF40;">
                            <?php if ($pr->stock_product == 'Sold-Out') { ?>
                                <div class="overlay-slick"></div>
                                <div class="ribbon-slick">
                                    <div class="ribbon-slick-content">
                                        <div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $pr->stock_product !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
                                <img src="<?= base_url('assets/img/') ?>product/<?= $pr->product_image; ?>" alt="<?= $pr->product_name ?>">
                                <?php if ($pr->stock_product !== 'Sold-Out') { ?>
                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>
                                        <div class="block2-btn-addcart-slick w-size30 trans-0-4">
                                            <div class="add_qty_cart_slick flex-w of-hidden">
                                                <button class="btn-num-product-down btn-qty-slick color1 flex-c-m bg8 eff4"><i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="qty-num-product-slick m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $pr->id; ?>">
                                                <button class="btn-num-product-up btn-qty-slick color1 flex-c-m bg8 eff4"><i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <button class="add-cart add_to_cart_slick flex-c-m hov7 s-text26 trans-0-4" data-productid="<?= $pr->id; ?>" data-productname="<?= $pr->product_name; ?>" data-productprice="<?= $fixed_price; ?>" data-producttime="<?= $pr->bursttime; ?>" data-action="add">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="block2-btn-notavailable w-size2 trans-0-4">
                                        <button class="btn_notavailable flex-c-m size26 bg11 bo-rad-10 s-text21 trans-0-4" disabled>
                                            Item Not Available
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="block3-txt p-b-10 text-center">
                                <h4>
                                    <a href="<?= base_url('homepage/detail/' . $pr->id); ?>" class="block2-product-name">
                                        <?= $pr->product_name ?>
                                    </a>
                                </h4>
                                <?php if ($discount !== '0') { ?>
                                    <span class="block2-oldprice m-text7 p-r-5">
                                        RP <?= number_format($price, '0', ',', '.') ?>
                                    </span>
                                    <span class="block2-newprice m-text8 p-r-5">
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
                <?php } ?>
            </div>
        </div>
    </div>
</section>