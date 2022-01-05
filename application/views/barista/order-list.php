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
            <div class="card-body pb-0" id="order-list-content">
                <?php
                foreach ($invoice as $invo) :
                    $waiting = $invo['order_status'] == 'Waiting';
                endforeach;
                if (isset($waiting)) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($invoice as $inv) :
                                $transaction_code = $inv['transaction_code'];
                                $transaction = $this->transaction_model->getTransaction($transaction_code);
                                if ($inv['order_status'] !== 'Complete') { ?>
                                    <tr class="text-center">
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <div class="row d-flex align-items-stretch">
                                                <div class="col align-items-stretch">
                                                    <div class="card bg-light">
                                                        <div class="card-body pt-2">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="row text-left">
                                                                        <div class="col-sm-4">
                                                                            <p class="text-sm mb-0"><b>Customer</b></p>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p class="text-sm mb-0"><b>:</b></p>
                                                                        </div>
                                                                        <div class="col-sm-7">
                                                                            <p class="text-sm mb-0"><?= $inv['customer_name']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row text-left">
                                                                        <div class="col-sm-4" style="height: 20px;">
                                                                            <p class="text-sm mb-0"><b>Table</b></p>
                                                                        </div>
                                                                        <div class="col-sm-1" style="height: 20px;">
                                                                            <p class="text-sm mb-0"><b>:</b></p>
                                                                        </div>
                                                                        <div class="col-sm-7" style="height: 20px;">
                                                                            <p class="text-sm"><?= $inv['table_name']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row text-left">
                                                                        <div class="col-sm-4">
                                                                            <p class="text-sm"><b>Process</b></p>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p class="text-sm mb-0"><b>:</b></p>
                                                                        </div>
                                                                        <div class="col-sm-7">
                                                                            <p class="text-sm mb-0"><?= $inv['total_bursttime']; ?> Minutes</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 text-right">
                                                                    <b>Invoice : <?= $inv['transaction_code']; ?></b>
                                                                </div>
                                                            </div>
                                                            <div class="card mb-0">
                                                                <div class="card-body p-0">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">No</th>
                                                                                <th>Product Name</th>
                                                                                <th>Quantity</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $iii = 1;
                                                                            foreach ($transaction as $t) : ?>
                                                                                <tr>
                                                                                    <td><?= $iii++; ?></td>
                                                                                    <td><?= $t['product_name']; ?></td>
                                                                                    <td><?= $t['quantity']; ?></td>
                                                                                    <td><?= $t['status_queue']; ?></td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer pt-1 pb-1">
                                                            <div class="text-right">
                                                                <button type="button" data-code="<?= $inv['transaction_code'] ?>" class="btn btn-sm btn-primary order_complete">
                                                                    <i class="fas fa-check-circle"></i> Complete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        No orders have been received yet.
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>