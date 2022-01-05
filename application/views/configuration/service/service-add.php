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
                        <li class="breadcrumb-item"><a href="<?= base_url('configuration/service') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/service') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/service/addnewservice') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('configuration/service'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('configuration/service/addnewservice'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="title">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?= set_value('title'); ?>" name="title" placeholder="Input title" id="title" class="form-control <?= form_error('title') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('title', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control <?= form_error('description') ? 'is-invalid' : null; ?>" id="description" name="description" rows="3" placeholder="description"><?= set_value('description'); ?></textarea>
                                                <?= form_error('description', '<small class="text-danger m-r-10">', '</small>'); ?>
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
                                        <div class="card-footer">
                                            <div class="col-md-4 col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('configuration/service'); ?>">Cancel</a>
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