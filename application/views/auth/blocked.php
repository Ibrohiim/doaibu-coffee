<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/admin/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/admin/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper" style="margin:0;">
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-yellow" style="margin: 0;"> 404</h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                        <p>
                            We could not find the page you were looking for.
                            Meanwhile, you may <a href="<?= base_url('auth') ?>">return to home page</a> or try using the search form.
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer" style="margin: 0;">
            <div class="pull-right hidden-xs">
                <b>Doa Ibu Coffee</b>
            </div>
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="">Doa Ibu</a>.</strong> All rights reserved.
        </footer>
    </div>
    <script src="<?= base_url('assets/'); ?>js/adminlte.min.js"></script>
</body>

</html>