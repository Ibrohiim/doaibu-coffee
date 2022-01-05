<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/adminlte.min.js"></script>
<!-- SweetAlert2 & Toastr -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<script>
    var flashLogin = $('#flash-login').data('flash');
    var flashLogout = $('#flash-logout').data('flash');
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "100",
        "hideDuration": "100",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeToggle",
        "hideMethod": "slideUp"
    }
    if (flashLogin) {
        toastr.error(flashLogin);
    } else if (flashLogout) {
        toastr.success(flashLogout);
    }
</script>
</body>

</html>