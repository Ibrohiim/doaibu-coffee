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
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/config') ?>">Configuration</a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/config/configlogo') ?>"><?= $title ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Configuration Website</h3>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('configuration/config/configlogo'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="website_name">Website Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?= $config['website_name'] ?>" name="website_name" placeholder="Input new website name" id="website_name" class="form-control <?= form_error('website_name') ? 'is-invalid' : null; ?>" />
                                        <?= form_error('website_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="icon" class="col-sm-2 control-label text-right">Icon Website</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="<?= base_url('assets/img/configuration/') . $config['icon']; ?>" class="img-thumbnail" id="image_load">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="icon">
                                                        <label class="custom-file-label" for="icon">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="alert alert-danger text-center p-2" style="margin-top: 10px;">
                                                    <strong>Attention!</strong><br>
                                                    If you don't want to change your website icon, don't complete this section.
                                                    Max size : 5mb
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo" class="col-sm-2 control-label text-right">Logo Website</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="<?= base_url('assets/img/configuration/') . $config['logo']; ?>" class="img-thumbnail">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                                        <label class="custom-file-label" for="logo">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="alert alert-danger text-center p-2" style="margin-top: 10px;">
                                                    <strong>Attention!</strong><br>
                                                    If you don't want to change your website logo, don't complete this section.
                                                    Max size : 5mb
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-2 col-md-offset-4 float-right">
                                    <a class="btn btn-default" href="<?= base_url('configuration/config/configlogo'); ?>">Cancel</a>
                                    <button class="btn btn-info float-right" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>