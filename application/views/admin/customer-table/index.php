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
                            <h3 class="card-title">Add New Table</h3>
                        </div>
                        <form role="form" action="<?= base_url('admin/table'); ?>" method="POST">
                            <div class="card-body" style="padding-bottom: 5px;">
                                <div class="form-group">
                                    <label for="table_code">Table Code</label>
                                    <input type="text" value="<?= $table_code; ?>" id="table_code" class="form-control" disabled />
                                    <input type="hidden" value="<?= $table_code; ?>" id="table_code" name="table_code" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="table_name">Table Name</label>
                                    <input type="text" value="<?= set_value('table_name'); ?>" name="table_name" placeholder="Input new table name" id="table_name" class="form-control <?= form_error('table_name') ? 'is-invalid' : null; ?>" />
                                    <?= form_error('table_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" value="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/table') ?>"><?= $title ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data for Customer Table</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Table Code</th>
                                        <th>Table</th>
                                        <th>Status</th>
                                        <th>Last Visit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($table as $tab) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $tab['table_code']; ?></td>
                                            <td><?= $tab['table_name']; ?></td>
                                            <td><?= $tab['status']; ?></td>
                                            <td><?= $tab['last_visit']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/table/edittable/') . $tab['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/table/delete/') . $tab['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Table Code</th>
                                        <th>Table</th>
                                        <th>Status</th>
                                        <th>Last Visit</th>
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