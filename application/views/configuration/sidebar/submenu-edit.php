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
                        <li class="breadcrumb-item"><a href="<?= base_url('configuration/sidebar/submenu') ?>"> Management SubMenu</a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/sidebar/submenu') ?>">Management SubMenu</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/sidebar/addsubmenu') ?>">Add New SubMenu</a></li>
                        <li class="nav-item"><a class="nav-link active" href=""><?= $title; ?></a></li>
                    </ul>
                    <?php foreach ($editsubmenu as $esm) { ?>
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <a href="<?= base_url('configuration/sidebar/submenu'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                                </a>
                            </div>
                            <form class="form-horizontal" method="POST" action="<?= base_url('configuration/sidebar/savesubmenu/'); ?>">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $esm->id ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="id">ID SubMenu</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?= $esm->id ?>" id="id" class="form-control" disabled />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="title">Submenu title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?= $esm->title ?>" name="title" placeholder="Input new title" id="title" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="menu_id">Menu ID</label>
                                                <div class="col-sm-8">
                                                    <select name="menu_id" id="menu_id" class="form-control">
                                                        <option value="<?= $esm->menu_id ?>">Select Menu</option>
                                                        <?php foreach ($menu as $m) : ?>
                                                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="url">SubMenu Url</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?= $esm->url ?>" name="url" placeholder="SubMenu Url" id="url" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="icon">SubMenu Icon</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?= $esm->icon ?>" name="icon" placeholder="SubMenu Icon" id="icon" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="is_active">Active?</label>
                                                <div class="col-sm-8">
                                                    <select name="is_active" id="is_active" class="form-control">
                                                        <option value="1">Active</option>
                                                        <option value="0" <?php if ($esm->is_active == "0") {
                                                                                echo "selected";
                                                                            } ?>>Not Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="col-md-4 col-md-offset-4 float-right">
                                                    <a class="btn btn-default" href="<?= base_url('configuration/sidebar/submenu'); ?>">Cancel</a>
                                                    <button class="btn btn-info float-right" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>