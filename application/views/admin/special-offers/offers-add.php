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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/offers') ?>"> list of Offers</a></li>
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
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/offers') ?>">List of Offers</a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/offers/addnewoffers') ?>"><?= $title; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/offers'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/offers/addnewoffers'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="offers_code">Offers Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $offers_code; ?>" id="offers_code" class="form-control" disabled />
                                                <input type="hidden" value="<?= $offers_code; ?>" id="offers_code" name="offers_code" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Offers Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('name'); ?>" name="name" placeholder="Input new offers name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control <?= form_error('description') ? 'is-invalid' : null; ?>" name="description" rows="3" placeholder="Description"></textarea>
                                                <?= form_error('description', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="information">Information</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control <?= form_error('information') ? 'is-invalid' : null; ?>" name="information" rows="3" placeholder="Information"></textarea>
                                                <?= form_error('information', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="expired">Expired</label>
                                            <div class="col-sm-8">
                                                <input type="date" value="<?= set_value('expired'); ?>" name="expired" placeholder="Input new offers expired" id="expired" class="form-control <?= form_error('expired') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('expired', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="activated">Activated</option>
                                                    <option value="deactivated">Deactivated</option>
                                                </select>
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
                                            <label class="col-sm-3 col-form-label" for="image">Offers Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 5px;">
                                                    <div class="col-sm">
                                                        <img src="<?= base_url('assets/img/offers/offers.jpg'); ?>" class="img-thumbnail" id="image_load">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-4 col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('admin/supplier'); ?>">Cancel</a>
                                                <button class="btn btn-info float-right" type="submit">Save</button>
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