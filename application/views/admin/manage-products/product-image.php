<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $subtitle; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/admin') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/products') ?>"><?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $subtitle; ?></li>
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
                    <a href="<?= base_url('admin/products'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                    </a>
                    <div class="card card-primary card-outline mt-2">
                        <form role="form" action="<?= base_url('admin/products/imageproduct/' . $product->id); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body" style="padding-bottom: 5px;">
                                <div class="form-group  ">
                                    <label for="product_name">Menu Name</label>
                                    <input type="text" value="<?= $product->product_name; ?>" id="product_name" class="form-control" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="image_name">Image Name</label>
                                    <input type="text" class="form-control <?= form_error('image_name') ? 'is-invalid' : null; ?>" name="image_name" id="image_name" placeholder="Input new image name">
                                    <?= form_error('image_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="previewimage" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-5">
                                            <img src="<?= base_url('assets/img/product/inputproduct.jpg'); ?>" class="img-thumbnail" id="image_load">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger pull-left">Reset</button>
                                <button type="submit" value="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href=""><?= $subtitle ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Menu Image</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Product</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $product->id; ?></td>
                                        <td><?= $product->product_name; ?></td>
                                        <td><img style="max-width: 40px;width: 100%" src="<?= base_url('assets/img/product/') . $product->product_image; ?>" class="img-circle" alt="product Image"></td>
                                        <td><?= $product->updated; ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <input type="hidden" <?= $i = 2; ?>>
                                    <?php foreach ($image as $im) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $im->id_product; ?></td>
                                            <td><?= $im->image_name; ?></td>
                                            <td><img style="max-width: 40px;width: 100%" src="<?= base_url('assets/img/product/thumbs/') . $im->image; ?>" class="img-circle" alt="product Image"></td>
                                            <td><?= $im->updated; ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/products/deleteimage/' . $product->id . '/' . $im->id_image); ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Product</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
                                        <th>Updated</th>
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