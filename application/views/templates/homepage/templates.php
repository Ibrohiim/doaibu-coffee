<?php
$site = $this->configuration_model->getConfig();
$navproduct = $this->products->navProduct();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $site['keywords'] ?>">
    <meta name="description" content="<?= $title ?>, <?= $site['description']; ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/') ?>configuration/<?= $site['icon'] ?>">

    <?php $this->load->view('templates/homepage/css') ?>

</head>

<body class="animsition">

    <!-- Header -->
    <?php $this->load->view('templates/homepage/topbar') ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $contents ?>

    <!-- Footer -->
    <footer class="p-b-20 bg12 footer-mobile">
        <div class="footer">
            <div class="footer-child2">
                <span class="footer-text">
                    Get connected with us on social networks!
                </span>
            </div>
            <div class="footer-social">
                <a href="<?= $site['facebook']; ?>" class="footer-social-item fa fa-facebook"></a>
                <a href="<?= $site['instagram']; ?>" class="footer-social-item fa fa-instagram"></a>
            </div>
        </div>
        <div class="container text-center text-md-left mt-4">
            <div class="row mt-3 -text">
                <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                    <h6 class="s-text28"><?= $site['website_name']; ?></h6>
                    <p class="s-text25" style="margin-bottom: 0px; padding-bottom: 0px"><a href="" class="s-text25">Terms of Us</a> | <a data-toggle="modal" data-target="#policeModal" href="" class="s-text25">Privacy Policy</a></p>
                    <p class="s-text29 w-size27">
                        Any questions? Let us know in store at <?= $site['address']; ?> or,
                        <br><i class="fa fa-envelope"></i> <?= $site['email']; ?>
                        <br><i class="fa fa-phone"></i> <?= $site['telephone']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="t-center p-l-15 p-r-15">
            <div class="t-center s-text8">
                Copyright © <?= date('Y'); ?> All rights reserved. | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.instagram.com/doaibucoffee/" target="_blank">Doa Ibu Coffee</a>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection -->
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

    <?php $this->load->view('templates/homepage/js') ?>

</body>

</html>