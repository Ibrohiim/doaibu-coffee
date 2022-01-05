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
                    <?php foreach ($editcategory as $ec) { ?>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <form role="form" action="<?= base_url('admin/products/savecategory'); ?>" method="POST">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $ec->id ?>">
                                <div class="card-body" style="padding-bottom: 5px;">
                                    <div class="form-group">
                                        <label for="category_slug">Category Slug</label>
                                        <input type="text" value="<?= $ec->category_slug ?>" name="category_slug" id="category_slug" class="form-control" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control <?= form_error('category_name') ? 'is-invalid' : null; ?>" name="category_name" id="category_name" value="<?= $ec->category_name ?>">
                                        <?= form_error('category_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="sorting">Sorting</label>
                                        <input type="number" class="form-control <?= form_error('sorting') ? 'is-invalid' : null; ?>" name="sorting" id="sorting" value="<?= $ec->sorting ?>">
                                        <?= form_error('sorting', '<small class="text-danger m-r-10">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="created">Date Created</label>
                                        <input type="text" value="<?= $ec->created ?>" name="created" id="created" class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" value="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href=""><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/products/categories') ?>">Add new category</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Product Category</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Slug</th>
                                        <th>Category</th>
                                        <th>Sorting</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($categories as $ca) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $ca['category_slug']; ?></td>
                                            <td><?= $ca['category_name']; ?></td>
                                            <td><?= $ca['sorting']; ?></td>
                                            <?php $date = $ca['created']; ?>
                                            <td><?= $date = date("Y-m-d") ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('admin/products/editcategory/') . $ca['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('admin/products/deletecategory/') . $ca['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Slug</th>
                                        <th>Category</th>
                                        <th>Sorting</th>
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