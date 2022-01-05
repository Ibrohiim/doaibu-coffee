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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/service') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/service/addnewservice') ?>">Add New Service</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for service</h3>
                        </div>
                        <div class="alert alert-warning" style="margin: 5px 20px;">
                            <p style="margin-bottom: 0;"><strong><i class="icon fas fa-exclamation-triangle"></i> The maximum that must be displayed is "3"</strong></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($service as $ser) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><a href="#detail<?= $ser['id']; ?>" data-toggle="modal" data-target="#detail<?= $ser['id']; ?>"><?= $ser['title']; ?></a></td>
                                            <td><?= word_limiter($ser['description'], 5); ?></td>
                                            <td>
                                                <?php
                                                if ($ser['status'] == 'not displayed') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/service/displayed/' . $ser['id']) ?>">Not Displayed</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('configuration/service/notdisplayed/' . $ser['id']) ?>">Displayed</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/service/edit/') . $ser['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('configuration/service/delete/') . $ser['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Description</th>
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
foreach ($service as $ser) : $no++; ?>
    <div class="modal fade" id="detail<?= $ser['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Service Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3><strong><?= $ser['title']; ?></strong></h3>
                    <div class="row">
                        <div class="col-3">
                            <p class="mb-0">Status</p>
                            <p class="mb-0">Description</p>
                        </div>
                        <div class="col-9">
                            <p class="mb-0"> : <?= $ser['description']; ?></p>
                            <p class="mb-0"> : <?php if ($ser['status'] == 'not displayed') {
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
                                        $date = date_create($ser['date']);
                                        echo date_format($date, 'd F Y')
                                        ?>
                                    </small>
                                </p>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>