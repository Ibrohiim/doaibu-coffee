<?php
$site = $this->configuration_model->getConfig();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/'); ?>img/configuration/<?= $site['icon'] ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/admin/adminlte.min.css">
    <!-- SweetAlert2 & Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">