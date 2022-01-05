<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/admin') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid" id="accordion">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Quick Help</h3>
                        </div>
                        <div class="card-body">
                            <div class="card mb-2">
                                <button type="button" class="btn btn-default btn-block btn-sm text-sm-left" data-toggle="collapse" href="#collapseOne">
                                    Proses pemesanan di website customer tidak bisa di proses
                                </button>
                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Pastikan settingan firebase sudah benar
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <button type="button" class="btn btn-default btn-block btn-sm text-sm-left" data-toggle="collapse" href="#collapseTwo">
                                    Print struk tidak berjalan
                                </button>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Pastikan koneksi ke printer, pastikan printer terdeteksi di sistem operasi. Port printer juga harus diperhatikan
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <button type="button" class="btn btn-default btn-block btn-sm text-sm-left" data-toggle="collapse" href="#collapseThree">
                                    Laporan tipe PDF tidak bisa di akses (print)
                                </button>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Masalah yang mungkin terjadi adalah jika anda menggunakan server linux sebagai webserver, pastikan folder aplikasi sudah mendapatkan hak akses penuh untuk read, write.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <button type="button" class="btn btn-default btn-block btn-sm text-sm-left" data-toggle="collapse" href="#collapseFour">
                                    Proses checkout tidak berjalan
                                </button>
                                <div id="collapseFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Kemungkinan masalah ada di path server pada settingan file base.php, perhatikan apakah semuanya sudah benar
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <button type="button" class="btn btn-default btn-block btn-sm text-sm-left" data-toggle="collapse" href="#collapseFive">
                                    Email tidak terkirim
                                </button>
                                <div id="collapseFive" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Pastikan settingan SMTP sudah sesuai, jika menggunakan gmail sebagai host, pastikan settingan dari sisi gmailnya sudah di aktifkan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Assistance to the Hims team</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                Please send an email to <a href='ibrohiimsh@gmail.com'>ibrohiimsh@gmail.com</a> to ask questions about this application
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>