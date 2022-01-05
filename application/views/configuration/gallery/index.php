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
        <div class="container-fluid">
            <div id="flash" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
            <div id="flash2" data-flash2="<?= $this->session->flashdata('changed'); ?>"></div>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/gallery') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/gallery/addnewgallery') ?>">Add New Gallery</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for gallery</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Captions</th>
                                        <th>Like</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($gallery as $gal) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><a href="#detailimg<?= $gal['id']; ?>" data-toggle="modal" data-target="#detailimg<?= $gal['id']; ?>"><?= $gal['name']; ?></a></td>
                                            <td><img style="max-width: 60px;width: 100%" src="<?= base_url('assets/img/gallery/') . $gal['image']; ?>" class="img" alt="<?= $gal['name']; ?>"></td>
                                            <td><?= word_limiter($gal['captions'], 5); ?></td>
                                            <td><?= $gal['likegallery']; ?></td>
                                            <td>
                                                <?php
                                                if ($gal['status'] == 'not displayed') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/gallery/displayed/' . $gal['id']) ?>">Not Displayed</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('configuration/gallery/notdisplayed/' . $gal['id']) ?>">Displayed</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/gallery/edit/') . $gal['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('configuration/gallery/delete/') . $gal['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Captions</th>
                                        <th>Like</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$no = 0;
foreach ($gallery as $gal) : $no++; ?>
    <div class="modal fade" id="detailimg<?= $gal['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gallery Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/gallery/') . $gal['image']; ?>" alt="<?= $gal['name']; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $gal['name']; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <?= $gal['captions']; ?>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Like</p>
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $gal['likegallery']; ?> Likes</p>
                                    <p class="mb-0"> : <?php if ($gal['status'] == 'not displayed') {
                                                            echo 'Not Displayed';
                                                        } else {
                                                            echo 'Displayed';
                                                        } ?>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <center>
                                        <p class="mb-0 mt-2">
                                            <small class="text-muted">
                                                Created at
                                                <?php
                                                $date = date_create($gal['date']);
                                                echo date_format($date, 'd F Y')
                                                ?>
                                            </small>
                                        </p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>