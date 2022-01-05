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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/products') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/products/addnewproduct') ?>">Add New Menu</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Menu</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock </th>
                                        <th>Discount</th>
                                        <th>Available</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($product as $pro) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $pro['product_code']; ?></td>
                                            <td>
                                                <a href="#detailproduct<?= $pro['id']; ?>" data-toggle="modal" data-target="#detailproduct<?= $pro['id']; ?>"><?= $pro['product_name']; ?></a>
                                            </td>
                                            <td><img style="max-width: 40px;width: 100%" src="<?= base_url('assets/img/product/') . $pro['product_image']; ?>" class="img" alt="<?= $pro['product_name']; ?>"></td>
                                            <td><?= $pro['category_name']; ?></td>
                                            <td><?= number_format($pro['price'], '0', ',', '.'); ?></td>
                                            <td>
                                                <?php
                                                if ($pro['stock_product'] == 'Sold-Out') : ?>
                                                    <a class="btn btn-danger btn-sm" href="<?= base_url('admin/products/readystock/' . $pro['id']) ?>">Sold Out</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/products/soldout/' . $pro['id']) ?>">Ready Stock</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $pro['current_discount']; ?></td>
                                            <td>
                                                <?php
                                                if ($pro['status_product'] == 'not displayed') : ?>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/products/displayed/' . $pro['id']) ?>">Not Displayed</i></a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/products/notdisplayed/' . $pro['id']) ?>">Displayed</i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/products/imageproduct/') . $pro['id']; ?>"><i class="fa fa-picture-o"></i> (<?= $pro['total_image'] ?>)</a>
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/products/editproduct/') . $pro['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/products/deleteproduct/') . $pro['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Discount</th>
                                        <th>Available</th>
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
<?php foreach ($product as $pro) : $no++; ?>
    <div class="modal fade" id="detailproduct<?= $pro['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailProductTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailProductLongTitle">Menu Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/product/') . $pro['product_image']; ?>" alt="<?= $pro['product_name']; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $pro['product_name']; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-2"><?= $pro['description']; ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Product Code</p>
                                    <p class="mb-0">Category</p>
                                    <p class="mb-0">Price</p>
                                    <p class="mb-0">Stock Product</p>
                                    <p class="mb-0">Size Product</p>
                                    <p class="mb-0">Discount Product</p>
                                    <p class="mb-0">Status Product</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $pro['product_code']; ?></p>
                                    <p class="mb-0"> : <?= $pro['category_name']; ?></p>
                                    <p class="mb-0"> : Rp <?= number_format($pro['price'], '0', ',', '.'); ?></p>
                                    <p class="mb-0"> : <?= $pro['stock_product']; ?></p>
                                    <p class="mb-0"> : <?= $pro['size']; ?></p>
                                    <p class="mb-0"> : <?= $pro['current_discount']; ?>%</p>
                                    <p class="mb-0"> : <?= $pro['status_product']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <p class="mb-0 mt-2">
                            <small class="text-muted">
                                Last updated
                                <?php
                                $date = date_create($pro['updated']);
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