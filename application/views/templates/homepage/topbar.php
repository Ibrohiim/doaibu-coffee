<?php
$site = $this->configuration_model->getConfig();
$navproduct = $this->products->navProduct();
$sidebarMenu = $this->products->categoryHome();

?>
<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar">
            <div class="topbar-social">
                <a href="<?= $site['facebook']; ?>" class="topbar-social-item fa fa-facebook"></a>
                <a href="<?= $site['instagram']; ?>" class="topbar-social-item fa fa-instagram"></a>
            </div>
            <span class="topbar-child1">
                <?= $site['tagline']; ?>
            </span>
            <div class="topbar-child2">
                <span class="topbar-email">
                    <?= $site['email']; ?>
                </span>
            </div>
        </div>
        <div class="wrap_header">
            <a href="" class="logo">
                <img src="<?= base_url('assets/img/') ?>configuration/<?= $site['logo'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
            </a>
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a <?= $this->uri->segment(1) == 'homepage' && $this->uri->segment(2) == null ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage'); ?>">Home</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'products' || $this->uri->segment(2) == 'categories' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/products'); ?>">Shop</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'offers' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/offers'); ?>">Special Offers</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'about' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/about'); ?>">About</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'contact' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/contact'); ?>">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-icons">
                <a href="<?= base_url('auth') ?>" class="header-wrapicon1 dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/user.png" class="header-icon1" alt="ICON">
                </a>
                <span class="linedivide1"></span>
                <div class="header-wrapicon2 cartcontent">

                </div>
            </div>
        </div>
        <?php if ($this->uri->segment(2) == 'products' || $this->uri->segment(2) == 'categories') { ?>
            <div class="wrap_menu" style="background-color: #faaf40;">
                <nav class="menu">
                    <ul class="main_menu">
                        <?php foreach ($categoryhome as $ch) { ?>
                            <li style="padding: 0 10px 5px 10px;">
                                <a style="color:black;" href="<?= base_url('homepage/categories/' . $ch->category_slug); ?>" class="s-text13 active1" <?php if ($this->uri->segment(3) == $ch->category_slug) { ?> style="border-bottom: 1px solid;" <?php } ?>>
                                    <?= $ch->category_name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        <?php } ?>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile fixed-top" <?= $this->uri->segment(2) == 'products' || $this->uri->segment(2) == 'categories' ? ' style="padding-bottom: 0"' : null ?>>
        <a href="#" class="logo-mobile">
            <img src="<?= base_url('assets/img/') ?>configuration/<?= $site['logo'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
        </a>
        <div class="btn-show-menu p-r-10">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <span class="linedivide2"></span>
                <div class="header-wrapicon2 m-r-10 cartcontent">

                </div>
            </div>
        </div>
    </div>
    <?php if ($this->uri->segment(2) == 'products' || $this->uri->segment(2) == 'categories') { ?>
        <div class="menu_header_mobile fixed-top" style="padding-bottom:0;margin-top:70px">
            <nav class="menu">
                <ul class="main_menu">
                    <?php foreach ($categoryhome as $ch) { ?>
                        <li style="padding: 0 10px 0 0">
                            <a href="<?= base_url('homepage/categories/' . $ch->category_slug); ?>" class="s-text13 active1" <?php if ($this->uri->segment(4) == $ch->category_slug) { ?> style="border-bottom: 1px solid;" <?php } ?>>
                                <?= $ch->category_name; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    <?php } ?>
    <!-- Bottom Navbar Mobile -->
    <div class="bottom_navbar_mobile fixed-bottom">
        <nav class="menu_mobile">
            <ul class="main_menu_mobile">
                <li>
                    <button class="footer-wrapicon dis-block show-sidebar">
                        <img src="<?= base_url('assets/'); ?>img/icons/menu-1.png" class="header-icon1" alt="ICON">
                    </button>
                </li>
                <li>
                    <a href="<?= base_url('homepage/offers') ?>" class="footer-wrapicon dis-block">
                        <img src="<?= base_url('assets/'); ?>img/icons/offers.png" class="header-icon1" alt="ICON">
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-wrapicon dis-block">
                        <img src="<?= base_url('assets/'); ?>img/icons/food.png" class="header-icon1" alt="ICON">
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('homepage/products') ?>" class="footer-wrapicon dis-block">
                        <img src="<?= base_url('assets/'); ?>img/icons/coffee-cup.png" class="header-icon1" alt="ICON">
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('auth') ?>" class="footer-wrapicon dis-block">
                        <img src="<?= base_url('assets/'); ?>img/icons/icon-user3.png" class="header-icon1" alt="ICON">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="row">
                <div class="col-12">
                    <a class="h5 mb-0 d-flex align-items-center">
                        <img class="logo-sidebar2" src="<?= base_url('assets/img/') ?>configuration/<?= $site['icon'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
                    </a>
                </div>
            </div>
            <button type="button" class="sidebar-closebtn">
                <span aria-hidden="true" style="font-size: 33px;font-weight: 100;">×</span>
            </button>
        </div>
        <div class="sidebar-body">
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <ul class="main-menu">
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage'); ?>" class="<?= $this->uri->segment(1) == 'homepage' && $this->uri->segment(1) == null ? ' nav-mobile-active' : null ?>"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage/products'); ?>" class="<?= $this->uri->segment(2) == 'products' || $this->uri->segment(2) == 'categories' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Shop</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage/offers'); ?>" class="<?= $this->uri->segment(2) == 'offers' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Special Offers</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage/about'); ?>" class="<?= $this->uri->segment(2) == 'about' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> About</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage/contact'); ?>" class="<?= $this->uri->segment(2) == 'contact' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Contact</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="<?= base_url('homepage/shopping'); ?>" class="<?= $this->uri->segment(2) == 'shopping' ? ' nav-mobile-active' : null ?>"><i class="fas fa-shopping-cart"></i> View Cart</a>
                        </li>
                    </ul>
                </nav>
            </aside>
        </div>
    </div>
</header>