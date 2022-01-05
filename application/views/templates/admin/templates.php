<?php
$site = $this->configuration_model->getConfig();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <?php $this->load->view('templates/admin/css') ?>
</head>

<!-- <body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse"> -->

<body class="hold-transition sidebar-mini layout-fixed text-sm <?= $this->uri->segment(3) == 'salestransactions' ? ' sidebar-collapse' : null ?><?= $this->uri->segment(3) == 'salestransactions' ? ' sidebar-collapse' : null ?>">

    <div class="wrapper">

        <!-- Topbar -->
        <?php $this->load->view('templates/admin/topbar') ?>
        <!-- /.topbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view('templates/admin/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $contents ?>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url('frontpage') ?>">Doa Ibu Coffee</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view('templates/admin/js') ?>
</body>

</html>