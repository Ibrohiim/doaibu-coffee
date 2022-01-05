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
                        <li class="breadcrumb-item"><a href="<?= base_url('configuration/slider') ?>"><?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/slider') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/slider/addnewslider') ?>">add new slider</a></li>
                        <li class="nav-item"><a class="nav-link active" href=""><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('configuration/slider'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('configuration/slider/editslider/' . $editslider->id_slider); ?>" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $editslider->id_slider ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Slider Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editslider->name; ?>" name="name" placeholder="Input slider name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="title">Slider Title</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editslider->title; ?>" name="title" placeholder="Input slider title" id="title" class="form-control <?= form_error('title') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('title', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="caption">Slider Caption</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editslider->caption; ?>" name="caption" placeholder="Input slider caption" id="caption" class="form-control <?= form_error('caption') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('caption', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="link">Link</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editslider->link; ?>" name="link" placeholder="Input link" id="link" class="form-control <?= form_error('link') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('link', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="text_link">Text Link</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editslider->text_link; ?>" name="text_link" placeholder="Input text link" id="text_link" class="form-control <?= form_error('text_link') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('text_link', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="is_active">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="is_active" id="is_active" class="form-control ">
                                                    <option value="1">Active</option>
                                                    <option value="0" <?php if ($editslider->is_active == "0") {
                                                                            echo "selected";
                                                                        } ?>>
                                                        Not Active
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="image">Slider Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 5px;">
                                                    <div class="col-sm">
                                                        <img src="<?= base_url('assets/img/configuration/slider/') . $editslider->image; ?>" class="img-thumbnail" id="image_load">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('configuration/slider'); ?>">Cancel</a>
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