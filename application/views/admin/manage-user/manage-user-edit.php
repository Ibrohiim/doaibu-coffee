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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/admin/manageuser/manageuser') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/manageuser/addnewuser') ?>">Add new user</a></li>
                        <li class="nav-item"><a class="nav-link active" href=""><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/manageuser/manageuser'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/manageuser/edituser/' . $edituser->id); ?>" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $edituser->id ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="username">Username</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $edituser->name ?>" name="name" placeholder="Input new username" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" /><?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="email">User Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $edituser->email ?>" name="email" placeholder="Input new user email" id="email" class="form-control <?= form_error('email') ? 'is-invalid' : null; ?>" /><?= form_error('email', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="role">User Role</label>
                                            <div class="col-sm-8">
                                                <select name="role" id="role" class="form-control">
                                                    <option value="<?= $edituser->role_id; ?>"><?= $edituser->role; ?></option>
                                                    <?php foreach ($role as $r) : ?>
                                                        <option <?= $edituser->role_id == $r['id'] ? 'hidden' : null ?> value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Active Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="1">Active</option>
                                                    <option value="0" <?php if ($edituser->is_active == "0") {
                                                                            echo "selected";
                                                                        } ?>>Not Active
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="userimage">User Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="userimage">
                                                        <label class="custom-file-label" for="userimage">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 10px;">
                                                    <img id="image_load" style="width: 50%" src="<?= base_url('assets/img/profile/') . $edituser->image; ?>" class="img" alt="<?= $edituser->name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('admin/manageuser/manageuser'); ?>">Cancel</a>
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