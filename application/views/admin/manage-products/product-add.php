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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/products') ?>"> <?= $title; ?></a></li>
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
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/products') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/products/addnewproduct') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/products'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/products/addnewproduct'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="product_code">Product Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $product_code; ?>" id="product_code" class="form-control <?= form_error('product_name') ? 'is-invalid' : null; ?>" disabled />
                                                <input type="hidden" value="<?= $product_code; ?>" id="product_code" name="product_code" class="form-control <?= form_error('product_name') ? 'is-invalid' : null; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="product_name">Product Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('product_name'); ?>" name="product_name" placeholder="Input new product name" id="product_name" class="form-control <?= form_error('product_name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('product_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="id_category">Category ID</label>
                                            <div class="col-sm-8">
                                                <select name="id_category" id="id_category" class="form-control <?= form_error('id_category') ? 'is-invalid' : null; ?>">
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($category as $ca) : ?>
                                                        <option value="<?= $ca['id']; ?>"><?= $ca['category_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_category', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="price">Product Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('price'); ?>" name="price" placeholder="Input new product price" id="price" class="form-control <?= form_error('price') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('price', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="stock_product">Stock Product</label>
                                            <div class="col-sm-8">
                                                <select name="stock_product" id="stock_product" class="form-control ">
                                                    <option value="Ready-Stock">Ready Stock</option>
                                                    <option value="Sold-Out">Sold Out</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="size">Size Product</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('size'); ?>" name="size" placeholder="Input new size product" id="size" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="bursttime">Burst Time</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('bursttime'); ?>" name="bursttime" placeholder="Input new burst time product" id="bursttime" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="created">Date Created</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= date('Y-m-d H:i:s'); ?>" id="created" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="current_discount">Current Discount</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('current_discount'); ?>" name="current_discount" id="current_discount" placeholder="New current discount" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status_product">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="status_product" id="status_product" class="form-control ">
                                                    <option value="displayed">Displayed</option>
                                                    <option value="not displayed">Not Displayed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="product_image">Product Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="product_image">
                                                        <label class="custom-file-label" for="product_image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 5px;">
                                                    <div class="col-md-5">
                                                        <img src="<?= base_url('assets/img/product/inputproduct.jpg'); ?>" class="img-thumbnail" id="image_load">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-6 float-right">
                                                <a class="btn btn-default" href="<?= base_url('admin/products'); ?>">Cancel</a>
                                                <button class="btn btn-danger" type="reset">Reset</button>
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>