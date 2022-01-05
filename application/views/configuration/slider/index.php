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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/slider') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/slider/addnewslider') ?>">Add New Slider</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for List Sliders</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Caption</th>
                                        <th>Link</th>
                                        <th>Active? </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($slider as $sl) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $sl['name']; ?></td>
                                            <td><img style="max-width: 250px;width: 100%" src="<?= base_url('assets/img/configuration/slider/') . $sl['image']; ?>" class="img" alt="<?= $sl['name']; ?>"></td>
                                            <td><?= word_limiter($sl['title'], 3); ?></td>
                                            <td><?= word_limiter($sl['caption'], 3); ?></td>
                                            <td><?= word_limiter($sl['link'], 3); ?></td>
                                            <td>
                                                <?php
                                                if ($sl['is_active'] == '0') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/slider/publish/' . $sl['id_slider']) ?>">Publish</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('configuration/slider/draft/' . $sl['id_slider']) ?>">Draft</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/slider/editslider/') . $sl['id_slider']; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('configuration/slider/deleteslider/') . $sl['id_slider']; ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Caption</th>
                                        <th>Link</th>
                                        <th>Active? </th>
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