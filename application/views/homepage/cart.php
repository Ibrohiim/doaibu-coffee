<img src="<?= base_url('assets/'); ?>img/icons/cart-1.png" class="header-icon1 js-show-header-dropdown" id="show-header-dropdown">
<span class="header-icons-noti">
    <?= $this->cart->total_items(); ?>
</span>
<div class="header-cart header-dropdown">
    <div class="header-cart-buttons p-b-5">
        <?php
        $odertype = $this->session->userdata('ordertype');
        if ($odertype == false) {
            $this->session->set_userdata('ordertype', 'Dine In');
        } else {
            if ($odertype == 'Dine In') { ?>
                <div class="header-cart-wrapbtn-type-order">
                    <button id="takeaway" class="flex-c-m size4 bg9 bo-rad-5 hov1 s-text21 trans-0-4 takeaway">
                        <i class="fa fa-shopping-basket"> Change To TAKE AWAY </i>
                    </button>
                </div>
            <?php } else { ?>
                <div class="header-cart-wrapbtn-type-order">
                    <button id="dinein" class="flex-c-m size4 bg10 bo-rad-5 hov1 s-text21 trans-0-4 dinein">
                        <i class="fas fa-utensils"> Change To DINE IN </i>
                    </button>
                </div>
        <?php }
        } ?>
    </div>
    <?php
    if (!empty($items)) { ?>
        <ul class="bo7 header-cart-wrapitem">
            <?php foreach ($items as $items) {
                $id_product = $items['id'];
                $product = $this->products->detailProduct($id_product);
                $total_bt[] = $items['qty'] * $items['bursttime'];
            ?>
                <li class="header-cart-item">
                    <div class="header-cart-item-img">
                        <img src="<?= base_url('assets/img/') ?>product/<?= $product->product_image ?>" alt="<?= $items['name'] ?>">
                    </div>
                    <div class="header-cart-item-txt">
                        <a href="<?= base_url('homepage/detail/' . $product->id) ?>" class="header-cart-item-name"><?= $items['name'] ?>
                        </a>
                        <span class="header-cart-item-info">
                            <div class="flex-w cart-items">
                                <div class="flex-w items-price">
                                    Rp <?= number_format($items['price'], '0', ',', '.') ?>
                                    <div class="flex-w bo5 cart-qty">
                                        <button class="btn-num-product-down color1 flex-c-m bg8 eff2 decrementqty" id="<?= $items['rowid'] ?>">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                        <input class="t-center num-product" type="number" min="1" id="quantity<?= $items['rowid'] ?>" value="<?= $items['qty'] ?>">
                                        <button class="btn-num-product-up color1 flex-c-m bg8 eff2 incrementqty" id="<?= $items['rowid'] ?>">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="items-subtotal">
                                    Rp <?= number_format($items['subtotal'], '0', ',', '.') ?>
                                    <button type="button" class="flex-c-m eff2 removecart" data-id="<?= $items['rowid'] ?>" data-name="<?= $items['name'] ?>">
                                        <i class="fs-12 fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </span>
                    </div>
                </li>
            <?php } ?>
            <div class="header-cart-total">
                <input type="hidden" value="<?= !empty($total_bt) ? array_sum($total_bt) : null ?>" name="total_bt" id="total-bt">
                Total: Rp <?= number_format($this->cart->total(), '0', ',', '.'); ?>
            </div>
        </ul>
        <div class="header-cart-buttons p-t-10">
            <div class="header-cart-wrapbtn">
                <a href="<?= base_url('homepage/shopping'); ?>" class="flex-c-m size26 bg1 bo-rad-10 hov1 s-text21 trans-0-4">
                    View Cart
                </a>
            </div>
            <div class="header-cart-wrapbtn">
                <button type="button" id="clear_cart" class="flex-c-m size26 bg1 bo-rad-10 hov1 s-text21 trans-0-4 clear_cart">
                    Clear the Cart
                </button>
            </div>
        </div>
    <?php } else { ?>
        <ul class="bo7 header-cart-wrapitem">
            <li class="header-cart-item">
                <p class="alert alert-success">empty shopping cart. <a href="<?= base_url('homepage/products') ?>">please order first</a></p>
            </li>
        </ul>
        <div class="header-cart-buttons p-t-5">
            <div class="header-cart-wrapbtn">
                <a href="<?= base_url('homepage/products'); ?>" class="flex-c-m size26 bg1 bo-rad-10 hov1 s-text21 trans-0-4">
                    Continue Order
                </a>
            </div>
            <div class="header-cart-wrapbtn">
                <button type="button" id="clear_cart" class="flex-c-m size26 bg1 bo-rad-10 hov1 s-text21 trans-0-4">
                    Clear the Cart
                </button>
            </div>
        </div>
</div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('.js-show-header-dropdown').on('click', function() {
            $(this).parent().find('.header-dropdown')
        });

        var menu = $('.js-show-header-dropdown');
        var sub_menu_is_showed = -1;

        for (var i = 0; i < menu.length; i++) {
            $(menu[i]).on('click', function() {

                if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
                    $(this).parent().find('.header-dropdown').toggleClass('show-header-dropdown');
                    sub_menu_is_showed = -1;
                } else {
                    for (var i = 0; i < menu.length; i++) {
                        $(menu[i]).parent().find('.header-dropdown').removeClass("show-header-dropdown");
                    }

                    $(this).parent().find('.header-dropdown').toggleClass('show-header-dropdown');
                    sub_menu_is_showed = jQuery.inArray(this, menu);
                }
            });
        }

        $(".js-show-header-dropdown, .header-dropdown").click(function(event) {
            event.stopPropagation();
        });

        $(window).on("click", function() {
            for (var i = 0; i < menu.length; i++) {
                $(menu[i]).parent().find('.header-dropdown').removeClass("show-header-dropdown");
            }
            sub_menu_is_showed = -1;
        });

    });
</script>
<script>
    $(document).ready(function() {
        function RefreshTableCart() {
            $("#mytable").load("<?= base_url('homepage/shopping'); ?> #mytable");
        }

        function RefreshFormConfirm() {
            $("#formconfirm").load("<?= base_url('homepage/shopping'); ?> #formconfirm");
        }

        function OpenCart() {
            $(document).ready(function() {
                var mq = window.matchMedia("(max-width: 992px)");
                if (mq.matches) {
                    $('.js-show-header-dropdown').click();
                } else {
                    $('#show-header-dropdown').click();
                }
            });
        }

        $(".removecart").click(function() {
            var id = $(this).data("id");
            var name = $(this).data("name");

            Swal.fire({
                title: 'Are you sure?',
                text: "You will remove " + name + " from your cart!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('homepage/removecart'); ?>",
                        method: "POST",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            $(".cartcontent").html(data);
                            RefreshFormConfirm();
                            RefreshTableCart();
                            OpenCart();
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": true,
                                "onclick": null,
                                "showDuration": "100",
                                "hideDuration": "100",
                                "timeOut": "1500",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeToggle",
                                "hideMethod": "slideUp"
                            }
                            toastr.success(name + " has been removed from cart!");
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success(name + " cancel deleted");
                }
            })
        });
        $('.clear_cart').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will remove " + name + " from your cart!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('homepage/clearcart'); ?>",
                        success: function(data) {
                            $('.cartcontent').html(data);
                            RefreshTableCart();
                            RefreshFormConfirm();
                            OpenCart();
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": true,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "300",
                                "timeOut": "1500",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeToggle",
                                "hideMethod": "slideUp"
                            }
                            toastr.success("Your cart successfully cleared!");
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Cart cancel to emptied");
                }
            })
        });
        $(".decrementqty").click(function() {
            var id = $(this).attr("id");
            var qty = $("#quantity" + id).val();
            $.ajax({
                url: "<?= base_url('homepage/decrementqty'); ?>",
                method: "POST",
                data: {
                    id: id,
                    qty: qty,
                },
                success: function(data) {
                    $(".cartcontent").html(data);
                    RefreshTableCart();
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("the cart has been updated!");
                }
            });
        });
        $(".incrementqty").click(function() {
            var id = $(this).attr("id");
            var qty = $("#quantity" + id).val();
            $.ajax({
                url: "<?= base_url('homepage/incrementqty'); ?>",
                method: "POST",
                data: {
                    id: id,
                    qty: qty,
                },
                success: function(data) {
                    $(".cartcontent").html(data);
                    RefreshTableCart();
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("the cart has been updated!");
                }
            });
        });
        $(".dinein").click(function() {

            $.ajax({
                url: "<?= base_url('homepage/dinein'); ?>",
                method: "POST",

                success: function(data) {
                    $(".cartcontent").html(data);
                    RefreshFormConfirm()
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Change To DINE IN!");
                }
            })
        });
        $(".takeaway").click(function() {

            $.ajax({
                url: "<?= base_url('homepage/takeaway'); ?>",
                method: "POST",

                success: function(data) {
                    $(".cartcontent").html(data);
                    RefreshFormConfirm()
                    OpenCart();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Change To TAKE AWAY!");
                }
            })
        });
    });
</script>