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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/offers') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/offers/addnewoffers') ?>">Add new Offers</a></li>
                        <li class="nav-item"><a class="nav-link active" href=""><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/offers'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/offers/edit/' . $editoffers->id); ?>" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $editoffers->id ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="offers_code">Offer Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editoffers->offers_code ?>" id="offers_code" class="form-control <?= form_error('offers_code') ? 'is-invalid' : null; ?>" disabled />
                                                <input type="hidden" value="<?= $editoffers->offers_code ?>" id="offers_code" name="offers_code" class="form-control <?= form_error('offers_code') ? 'is-invalid' : null; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Offer Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editoffers->name ?>" name="name" placeholder="Input new offer name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" rows="3"><?= $editoffers->description ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="information">Information</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="information" rows="3"><?= $editoffers->information ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="expired">Expired</label>
                                            <div class="col-sm-8">
                                                <input type="date" value="<?= $editoffers->expired ?>" name="expired" placeholder="Input new offers expired" id="expired" class="form-control <?= form_error('expired') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('expired', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="created">Date Created</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editoffers->created ?>" id="created" name="created" class="form-control" disabled />
                                                <input type="hidden" value="<?= $editoffers->created ?>" id="created" name="created" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="activated">Activated</option>
                                                    <option value="deactivated" <?php if ($editoffers->status == "deactivated") {
                                                                                    echo "selected";
                                                                                } ?>>
                                                        Deactivated
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="image">Offer Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 10px;">
                                                    <img id="image_load" style="width: 50%" src="<?= base_url('assets/img/offers/') . $editoffers->image; ?>" class="img" alt="<?= $editoffers->name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-6 float-right">
                                                <a class="btn btn-default" href="<?= base_url('admin/offers'); ?>">Cancel</a>
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