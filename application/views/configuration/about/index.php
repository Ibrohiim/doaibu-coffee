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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div id="flash" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#about" data-toggle="tab">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="about">
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-4 p-b-30">
                                                <img class="img-fluid" src="<?= base_url('assets/img/configuration/') . $about['image']; ?>" alt="IMG-ABOUT">
                                            </div>

                                            <div class="col-md-8 p-b-30">
                                                <h3 class="m-text26 p-t-15 p-b-16">
                                                    <?= $about['title'] ?>
                                                </h3>
                                                <p class="p-b-28">
                                                    <?= $about['description']; ?>
                                                </p>
                                                <div class="bo13 p-l-29 m-l-9 p-b-10">
                                                    <p class="p-b-11">
                                                        <?= $about['quotes']; ?>
                                                    </p>
                                                    <span class="s-text7">
                                                        - <?= $about['author']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST" action="<?= base_url('configuration/about'); ?>" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="title">Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?= $about['title'] ?>" name="title" placeholder="Input title" id="title" class="form-control <?= form_error('title') ? 'is-invalid' : null; ?>" />
                                                    <?= form_error('title', '<small class="text-danger m-r-10">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="description">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" rows="3" placeholder="Description"><?= $about['description'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="quotes">Quotes</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="quotes" rows="3" placeholder="Input quotes"><?= $about['quotes'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="author">Author</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?= $about['author'] ?>" name="author" placeholder="Input author" id="author" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-2 control-label">About Image</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <img src="<?= base_url('assets/img/configuration/') . $about['image']; ?>" class="img-thumbnail" id="image_load">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="previewimage" name="about_image">
                                                                    <label class="custom-file-label" for="about_image">Choose file</label>
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
                                            <div class="card-footer">
                                                <div class="col-md-2 col-md-offset-4 float-right">
                                                    <a class="btn btn-default" href="<?= base_url('configuration/about'); ?>">Cancel</a>
                                                    <button class="btn btn-info float-right" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>