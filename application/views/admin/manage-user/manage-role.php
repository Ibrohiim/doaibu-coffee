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
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Role</h3>
                        </div>
                        <form role="form" action="<?= base_url('admin/manageuser'); ?>" method="POST">
                            <div class="card-body" style="padding-bottom: 5px;">
                                <div class="form-group">
                                    <label for="role">New Role</label>
                                    <input type="text" class="form-control <?= form_error('role') ? 'is-invalid' : null; ?>" name="role" id="role" placeholder="Input new role">
                                    <?= form_error('role', '<small class="text-danger m-r-10">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/manageuser') ?>"><?= $title ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Manage Role</h3>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($role as $r) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $r['role']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/manageuser/roleaccess/') . $r['id']; ?>"><i class="fa fa-cogs"></i></a>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editrole<?= $r['id']; ?>"><i class="fa fa-edit"></i></button>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/manageuser/deleterole/') . $r['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Role</th>
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
<?php foreach ($role as $r) : $no++; ?>
    <div class="modal fade" id="editrole<?= $r['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('admin/manageuser/updaterole') ?>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $r['id'] ?>">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?= $r['role']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>