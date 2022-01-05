<?php if ($invoice == true) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10px">No</th>
                <th>Orders</th>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" <?= $i = 1; ?>>
            <?php foreach ($invoice as $inv) :
                $transaction_code = $inv['transaction_code'];
                $query = "SELECT *
                            FROM `transaction` JOIN `products`
                            ON `transaction`.`id_product` = `products`. `id`
                            WHERE `transaction`.`transaction_code` = '$transaction_code'
                            ORDER BY `transaction`.`id_transaction` ASC
                            ";
                $transaction = $this->db->query($query)->result_array();
            ?>
                <tr class="text-center">
                    <td><?= $i++; ?></td>
                    <td>
                        <?php if ($inv['order_status'] !== 'Complete') { ?>
                            <div class="row d-flex align-items-stretch">
                                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <?php if ($inv['order_status'] == 'Process') { ?>
                                            <div class="overlay dark">
                                                <a href="<?= base_url('barista/orderlist/setcomplete/' . $inv['transaction_code']) ?>" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check-circle"></i> Complete
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="card-header border-bottom-0">
                                            <b>Invoice : <?= $inv['transaction_code']; ?></b>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-sm-3" style="height: 20px;">
                                                    <p class="text-sm mb-0"><b>Table</b></p>
                                                </div>
                                                <div class="col-sm-1" style="height: 20px;">
                                                    <p class="text-sm mb-0"><b>:</b></p>
                                                </div>
                                                <div class="col-sm-4" style="height: 20px;">
                                                    <p class="text-sm"><?= $inv['table_number']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="text-sm"><b>Customer</b></p>
                                                </div>
                                                <div class="col-sm-1">
                                                    <p class="text-sm mb-0"><b>:</b></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p class="text-sm mb-0"><?= $inv['customer_name']; ?></p>
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
                                                                <th style="width: 40px">Label</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <input type="hidden" <?= $i = 1; ?>>
                                                            <?php foreach ($transaction as $t) : ?>
                                                                <tr>
                                                                    <td><?= $i++; ?></td>
                                                                    <td><?= $t['product_name']; ?></td>
                                                                    <td><?= $t['quantity']; ?></td>
                                                                    <td><span class="badge bg-danger">55%</span></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer pt-1 pb-1">
                                            <div class="text-right">
                                                <a href="<?= base_url('barista/orderlist/setprocess/' . $inv['transaction_code']) ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-sync-alt"></i></i> Process
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                                </div>
                            </div>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
        No orders have been received yet.
    </div>
<?php } ?>