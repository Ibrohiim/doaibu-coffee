<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form action="<?= base_url('user/user/changepass'); ?>" method="POST">
                                        <div class="form-group">
                                            <label class="form-control-label" for="current_password">Current Password</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="new_password1">New Password</label>
                                            <input type="password" class="form-control" id="new_password1" name="new_password1">
                                            <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="new_password2">Repeat Password</label>
                                            <input type="password" class="form-control" id="new_password2" name="new_password2">
                                            <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-12 text-right">
                                                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-success">Change Password</button>
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