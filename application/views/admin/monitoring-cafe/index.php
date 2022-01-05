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
        <div class="card card-solid" id="customer-table">
            <div class="card-body pb-0" id="customer-table-list">
                <div class="row d-flex align-items-stretch">
                    <?php foreach ($custTable as $ct) :
                        $status     = $ct['status'];;
                        if ($status == 'active') {
                            $icon   = 'fas fa-utensils';
                            $color  = 'bg-info';
                            $desc   = 'The table is filled';
                        } else {
                            $icon   = 'fas fa-door-open';
                            $color  = 'bg-secondary';
                            $desc   = 'The table is empty';
                        }
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-body" style="padding: 10px 10px 0 10px;">
                                    <div class="row">
                                        <div class="col-5 text-center">
                                            <div class="info-box shadow p-0 mb-3">
                                                <span class="info-box-icon <?= $color; ?> elevation-2" style="width:inherit;"><i class="<?= $icon; ?>"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <p class="text-md mb-0 mt-2"><b><?= $ct['table_name']; ?></b></p>
                                            <p class="text-muted text-sm mb-1"><b>(<?= $desc; ?>)</b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="padding: 6px 10px 6px 10px;">
                                    <div class="text-right">
                                        <?php if ($status === 'active') { ?>
                                            <button type="button" data-id="<?= $ct['id'] ?>" data-name="<?= $ct['table_name'] ?>" class=" btn btn-sm btn-info elevation-2 change_leave">
                                                <i class="fas fa-sign-in-alt"></i></i> Set Leave
                                            </button>
                                        <?php } else { ?>
                                            <button type="button" data-id="<?= $ct['id'] ?>" data-name="<?= $ct['table_name'] ?>" class=" btn btn-sm btn-warning elevation-2 change_active">
                                                <i class="fas fa-check-circle"></i></i> Set Active
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>