<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div id="flash-login" data-flash="<?= $this->session->flashdata('flashLogin'); ?>"></div>
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
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?= $user['name']; ?></h3>
                            <p class="text-muted text-center">
                                <?php $rt = $user['role_id'];
                                $roleTopbar = $this->db->where('id', $rt)->get('user_role')->row_array();
                                echo $roleTopbar['role'];
                                ?>
                            </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $user['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right"><?php $active = $user['is_active'];
                                                                            if ($active == 1) {
                                                                                echo 'Active';
                                                                            } else {
                                                                                echo 'Not Active';
                                                                            } ?></a>
                                </li>
                            </ul>
                            <center>
                                <p class="mb-0 text-muted">
                                    <?php
                                    $date = date_create($user['created_at']);
                                    echo date_format($date, 'd F Y')
                                    ?>

                                </p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item" style="margin-right: 10px;"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                                <li class="nav-item"><a class="nav-link active" href="<?= base_url('user/user/changepass'); ?>">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="<?= base_url('user/user'); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id'] ?>">
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" id="name" value="<?= $user['name']; ?>">
                                                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" id="image_load"">
                                                    </div>
                                                    <div class=" col-md-9">
                                                        <div class="alert alert-danger text-center p-2">
                                                            <strong>Attention!</strong><br>
                                                            If you don't want to change your profile photo, don't complete this section.
                                                            Max size : 5mb
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="previewimage" name="image">
                                                                <label class="custom-file-label" for="image">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
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