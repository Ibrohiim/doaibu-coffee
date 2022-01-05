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
        <div class="card card-solid" id="order-list">
            <div class="card-body pb-0" id="order-queue-content">
                <div class="row">
                    <div class="col-12">
                        <h5>Pengurutkan Arus Antrian </h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Proses</th>
                                    <th>Meja</th>
                                    <th>Waktu pesan</th>
                                    <th>Pesanan</th>
                                    <th>jumlah</th>
                                    <th>Bursttime</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($antrian as $an) :
                                    $time = date_create($an['transaction_date']);
                                ?>
                                    <tr>
                                        <td><?= 'P', $i++; ?></td>
                                        <td><?= $an['table_name']; ?></td>
                                        <td><?= date_format($time, 'H.i'); ?></td>
                                        <td><?= $an['product_name']; ?></td>
                                        <td><?= $an['qty']; ?></td>
                                        <td><?= $an['bursttime']; ?> Minutes</td>
                                        <td><?= $an['status_queue']; ?></td>
                                        <td><?php if ($an['status_queue'] == 'Process') { ?>
                                                <button type="button" data-hour="<?= date_format($time, 'H') ?>" data-minute="<?= date_format($time, 'i') ?>" data-product="<?= $an['id_product'] ?>" class="btn btn-sm btn-success order_complete">
                                                    <i class="fas fa-check-circle"></i> Complete
                                                </button>
                                            <?php } else { ?>
                                                <button type="button" data-hour="<?= date_format($time, 'H') ?>" data-minute="<?= date_format($time, 'i') ?>" data-product="<?= $an['id_product'] ?>" class=" btn btn-sm btn-primary order_process">
                                                    <i class="fas fa-sync-alt"></i></i> Process
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>