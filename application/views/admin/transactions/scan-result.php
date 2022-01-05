<?php if (!empty($transaction_code)) { ?>
    <div class="card">
        <div class="card-header">
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marker-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Table Number</span>
                            <span class="info-box-number">
                                <?= $table_number ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-id-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Order Type</span>
                            <span class="info-box-number">
                                <?= $order_type ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-id-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Customer Name</span>
                            <span class="info-box-number">
                                <?= $customer_name ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Transaction</span>
                            <span class="info-box-number">
                                <?= $total_transaction; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-12">
                    <a href="<?= base_url('admin/transactions/salestransactions/' . $transaction_code) ?>" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Process Payment
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="card">
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
<?php } ?>