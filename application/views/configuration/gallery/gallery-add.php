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
                        <li class="breadcrumb-item"><a href="<?= base_url('configuration/gallery') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/gallery') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/gallery/addnewgallery') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('configuration/gallery'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('configuration/gallery/addnewgallery'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?= set_value('name'); ?>" name="name" placeholder="Input name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="captions">Captions</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control <?= form_error('captions') ? 'is-invalid' : null; ?>" id="captions" name="captions" rows="3" placeholder="captions"><?= set_value('captions'); ?></textarea>
                                                <?= form_error('captions', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="like">Like</label>
                                            <div class="col-sm-9">
                                                <input type="number" value="<?= set_value('like'); ?>" name="like" placeholder="Input like" id="like" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Select Status</label>
                                            <div class="col-sm-9">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="displayed">Displayed</option>
                                                    <option value="not displayed">Not Displayed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="image">Gallery Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-sm">
                                                                <img src="<?= base_url('assets/img/gallery/default.jpg') ?>" class="img-thumbnail" id="image_load">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="alert alert-danger text-center p-2" style="margin-top: 10px;">
                                                            <strong>Attention!</strong><br>
                                                            If you don't want to change your website icon, don't complete this section.
                                                            Max size : 5mb
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-2 col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('configuration/gallery'); ?>">Cancel</a>
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