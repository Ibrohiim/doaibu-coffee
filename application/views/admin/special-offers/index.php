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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/offers') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/offers/addnewoffers') ?>">Add Offers</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Special Offers</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Offers Code</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Information</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($offers as $off) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $off['offers_code']; ?></td>
                                            <td>
                                                <a href="#detail<?= $off['id']; ?>" data-toggle="modal" data-target="#detail<?= $off['id']; ?>"><?= $off['name']; ?></a>
                                            </td>
                                            <td>
                                                <img style="max-width: 50px;width: 100%" src="<?= base_url('assets/img/offers/') . $off['image']; ?>" class="img" alt="<?= $off['name']; ?>">
                                            </td>
                                            <td><?= word_limiter($off['description'], 3); ?></td>
                                            <td><?= word_limiter($off['information'], 3); ?></td>
                                            <td>
                                                <?php
                                                if ($off['expired'] < date('Y-m-d')) : echo '<p style="font-weight:bold;color:#dc3545;">Expired!</p>';
                                                else : echo $off['expired'];
                                                endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($off['status'] == 'deactivated') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/offers/activated/' . $off['id']) ?>">Deactivated</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/offers/deactivated/' . $off['id']) ?>">Activated</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $off['created']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/offers/edit/') . $off['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/offers/delete/') . $off['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Offers Code</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Information</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th>Created</th>
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

<input type="hidden" <?= $no = 0; ?>>
<?php foreach ($offers as $off) : $no++; ?>
    <div class="modal fade" id="detail<?= $off['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailLongTitle">Offers Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/offers/') . $off['image']; ?>" alt="<?= $off['name']; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $off['name']; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-2"><?= $off['description']; ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Offers Code</p>
                                    <p class="mb-0">Information</p>
                                    <p class="mb-0">Expired</p>
                                    <p class="mb-0">Status</p>
                                    <p class="mb-0">Created</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $off['offers_code']; ?></p>
                                    <p class="mb-0"> : <?= $off['information']; ?></p>
                                    <p class="mb-0"> : <?= $off['expired']; ?></p>
                                    <p class="mb-0"> : <?= $off['status']; ?></p>
                                    <p class="mb-0"> : <?= $off['created']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <p class="mb-0 mt-2">
                            <small class="text-muted">
                                Last updated
                                <?php
                                $date = date_create($off['updated']);
                                echo date_format($date, 'd F Y')
                                ?>
                            </small>
                        </p>
                    </center>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>