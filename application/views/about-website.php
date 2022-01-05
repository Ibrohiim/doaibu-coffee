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
                            <h3 class="card-title">Hims Developer Team</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img src="<?= base_url('assets/img/profile/ibrohiim.png') ?>" class="mr-3 rounded-circle" width="50" src="" alt="Hasnah">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Project Manager & Front End Developer</div>
                                        <div class="media-title">Ibrohiim</div>
                                        <span class="text-small text-muted">ibrohiimsh@gmail.com</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="<?= base_url('assets/img/profile/ibrohiim.png') ?>" class="mr-3 rounded-circle" width="50" src="" alt="Adit">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Backend Developer</div>
                                        <div class="media-title">Ibrohiim</div>
                                        <span class="text-small text-muted">ibrohiimsh@gmail.com</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="<?= base_url('assets/img/profile/ibrohiim.png') ?>" class="mr-3 rounded-circle" width="50" src="" alt="Anna">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Asset & Documentation</div>
                                        <div class="media-title">Ibrohiim</div>
                                        <span class="text-small text-muted">ibrohiimsh@gmail.com</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="<?= base_url('assets/img/profile/ibrohiim.png') ?>" class="mr-3 rounded-circle" width="50" src="" alt="Adam">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Dev Ops</div>
                                        <div class="media-title">Ibrohiim</div>
                                        <span class="text-small text-muted">ibrohiimsh@gmail.com</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="<?= base_url('assets/img/profile/ibrohiim.png') ?>" class="mr-3 rounded-circle" width="50" src="" alt="Rizky">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Microservice</div>
                                        <div class="media-title">Ibrohiim</div>
                                        <span class="text-small text-muted">ibrohiimsh@gmail.com</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Hims Developer Team</h3>
                        </div>
                        <div class="card-body">
                            <p id='divKontributor'>
                                Terima kasih kepada teman teman yang telah membantu Haxorsprogramming club yang telah memberikan bantuan dalam bentuk apapun. Sedikit banyaknya bantuan dari teman teman,
                                sangat memberikan impact yang luar biasa kepada kami.
                                <br />Tertarik menjadi kontributor? ... Silahkan kunjungi
                                <a href='https://github.com/haxorsprogramming/Haxors-Contributors' target="_new">
                                    <h4>Haxors Contributors Programs</h4>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tentang Aplikasi</h3>
                        </div>
                        <div class="card-body">
                            <div style="text-align: center;margin-bottom:15px;">
                                <img src="<?= base_url('assets/img/configuration/') . $config['icon']; ?>" style="width: 200px;">
                            </div>
                            <p style="text-align: justify;">
                                <strong>Doa Ibu Coffee</strong> adalah salah satu project aplikasi yang dikembangkan oleh Haxorsprogramming club.
                                Kami berkomitmen untuk selalu mengembangkan aplikasi yang dapat digunakan secara menyeluruh bagi pemilik usaha tanpa mengenal
                                batasan batasan yang selama ini mungkin menjadi penghalan bagi pelaku usaha dalam melakukan proses digitalisasi dalam usaha mereka. Haxorsprogrammingclub
                                juga akan selalu menerima kritik & saran dari teman teman baik itu pemilik usaha ataupun para developer developer lain yang mungkin bisa memberikan
                                masukan atau saran kepada kami. Aplikasi yang dibuat oleh Haxorsprogrammingclub sepenuhnya berlisensi opensource (MIT) yang artinya dapat digunakan secara gratis,
                                serta bagi teman teman yang ingin membantu pengembangan lebih lanjut, juga kami persilahkan untuk membedah & memperbaiki aplikasi yang kami kembangkan.
                            </p>
                            <p style="text-align: justify;">
                                Apabila teman teman ingin bertanya tanya seputar project yang sedang dikembangkan oleh haxorsprogramming dapat menguhubungi : <br />
                                Whatsapp : <strong>082272177022</strong><br />
                                Email : <strong>alditha.forum@gmail.com</strong><br />
                                Instagram : <strong>haxorsprogramming</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>