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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/manageuser/manageuser') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/manageuser/addnewuser') ?>">Add New User</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Management User</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Active</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($manageuser as $mu) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $mu['name']; ?></td>
                                            <td><a href="#detailuser<?= $mu['id']; ?>" data-toggle="modal" data-target="#detailuser<?= $mu['id']; ?>"><?= $mu['email']; ?></a></td>
                                            <td><img style="max-width: 40px;width: 100%" src="<?= base_url('assets/img/profile/') . $mu['image']; ?>" class="img-circle" alt="<?= $mu['name']; ?>"></td>
                                            <td><?= $mu['role']; ?></td>
                                            <td>
                                                <?php
                                                if ($mu['is_active'] == '0') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/manageuser/activeuser/' . $mu['id']) ?>">Not Active</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/manageuser/notactiveuser/' . $mu['id']) ?>">Active</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $mu['created_at']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/manageuser/edituser/') . $mu['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/manageuser/deleteuser/') . $mu['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Active</th>
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
<?php foreach ($manageuser as $mu) : $no++; ?>
    <div class="modal fade" id="detailuser<?= $mu['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/profile/') . $mu['image']; ?>" alt="<?= $mu['name']; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $mu['name']; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <?= $mu['email']; ?>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Role</p>
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $mu['role']; ?></p>
                                    <p class="mb-0"> : <?php if ($mu['is_active'] == '0') {
                                                            echo 'Not Active';
                                                        } else {
                                                            echo 'Active';
                                                        } ?>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <center>
                                        <p class="mb-0 mt-2">
                                            <small class="text-muted">
                                                Created at
                                                <?php
                                                $date = date_create($mu['created_at']);
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