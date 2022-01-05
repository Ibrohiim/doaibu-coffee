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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/config') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('configuration/config/configlogo') ?>">Config Logo</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Configuration Website</h3>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('configuration/config'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="website_name">Website Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $config['website_name'] ?>" name="website_name" placeholder="Input new website name" id="website_name" class="form-control <?= form_error('website_name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('website_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="tagline">Tagline/Moto</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $config['tagline'] ?>" name="tagline" placeholder="Input new tagline/moto" id="tagline" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="website">Website</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $config['website'] ?>" name="website" placeholder="Input new link website" id="website" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="email">Email Address</label>
                                            <div class="col-sm-8">
                                                <input type="email" value="<?= $config['email'] ?>" name="email" placeholder="Input new email" id="email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="facebook">Facebook</label>
                                            <div class="col-sm-8">
                                                <input type="url" value="<?= $config['facebook'] ?>" name="facebook" placeholder="Input new facebook" id="facebook" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="instagram">Instagram</label>
                                            <div class="col-sm-8">
                                                <input type="url" value="<?= $config['instagram'] ?>" name="instagram" placeholder="Input new instagram" id="instagram" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="telephone">Telephone</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $config['telephone'] ?>" name="telephone" placeholder="Input new telephone" id="telephone" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="address">Address</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="address" rows="2" placeholder="Address"><?= $config['address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="updated">Date Updated</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= date('Y-m-d H:i:s'); ?>" id="updated" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="keywords">Keywords</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="keywords" rows="3" placeholder="Keywords(for google SEO)"><?= $config['keywords'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="metatext">Code Metatext</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="metatext" rows="3" placeholder="Code Metatext"><?= $config['metatext'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" rows="3" placeholder="Description"><?= $config['description'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="payment_account">Payment Account</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="payment_account" rows="3" placeholder="Payment Account"><?= $config['payment_account'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-4 col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('configuration/config'); ?>">Cancel</a>
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