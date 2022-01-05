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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/manageuser/manageuser') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/manageuser/manageuser') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/manageuser/addnewuser') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/manageuser/manageuser'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/manageuser/addnewuser/'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">New User Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('name'); ?>" name="name" placeholder="Input new name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="email">New User Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" value="<?= set_value('email'); ?>" name="email" placeholder="Input new user email" id="email" class="form-control <?= form_error('email') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('email', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="password">New User Password</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('password'); ?>" name="password" placeholder="Input new password" id="password" class="form-control <?= form_error('password') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('password', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="created_at">Date Created</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= date('Y-m-d H:i:s'); ?>" name="created_at" id="created_at" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="role_id">Role ID</label>
                                            <div class="col-sm-8">
                                                <select name="role_id" id="role_id" class="form-control <?= form_error('role_id') ? 'is-invalid' : null; ?>">
                                                    <option value="">Select Role</option>
                                                    <?php foreach ($role as $r) : ?>
                                                        <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('role', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="is_active">Active?</label>
                                            <div class="col-sm-8">
                                                <select name="is_active" id="is_active" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('admin/manageuser/manageuser'); ?>">Cancel</a>
                                                <button class="btn btn-warning" type="reset">Reset</button>
                                                <button class="btn btn-info" type="submit">Save</button>
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