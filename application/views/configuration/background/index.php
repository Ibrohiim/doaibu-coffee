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
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href=""><?= $title ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($background as $bg) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $bg->name; ?></td>
                                            <td><img style="max-width: 250px;width: 100%" src="<?= base_url('assets/img/configuration/background/') . $bg->image; ?>" class="img" alt="<?= $bg->name; ?>"></td>
                                            <td><?= $bg->updated; ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-bg" id="edit-bg"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="padding-top: 35px;">
                    <div class="card" id="bg-setting">
                        <div class="card-header">
                            <h3 class="card-title">Add New Background</h3>
                        </div>
                        <form role="form" action="<?= base_url('configuration/background'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body" style="padding-bottom: 5px;">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" name="name" id="name" placeholder="Input new name">
                                    <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="image">Background Image</label>
                                    <div class="row" style="margin-bottom: 8px;">
                                        <div class="col-sm">
                                            <img src="<?= base_url('assets/img/configuration/background/background.jpg'); ?>" class="img-thumbnail" id="image_load">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="previewimage" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" value="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

</script>