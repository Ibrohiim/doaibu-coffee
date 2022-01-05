<style type="text/css">
    @media print {

        header,
        .nav-tabs,
        .card-header,
        .footer,
        footer {
            display: none;
        }
    }

    .table-detail-transaction td {
        padding: 0 0.75rem;
        vertical-align: top;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $subtitle; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/admin') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/transactions/listtransactions') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/transactions/listtransactions') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/transactions/sales') ?>">Add New Transaction</a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/transactions/listtransactions') ?>"><?= $subtitle ?></a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('admin/transactions/listtransactions'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Doa Ibu Coffee
                                            <small class="float-right"><b>Invoice #<?= $invoice['transaction_code']; ?></b></small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row invoice-info pb-2 pt-2">
                                    <div class="col-sm-3 invoice-col">
                                        <table class="table table-sm table-borderless table-detail-transaction">
                                            <tbody>
                                                <tr>
                                                    <td><b>Operator</b></td>
                                                    <td>: Admin</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Cashier</b></td>
                                                    <td>: <?= $invoice['cashier']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Order Type</b></td>
                                                    <td>: <?= $invoice['order_type']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Table</b></td>
                                                    <td>: <?= $invoice['table_name']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <table class="table table-sm table-borderless table-detail-transaction">
                                            <tbody>
                                                <tr>
                                                    <td><b>Customer</b></td>
                                                    <td>: <?= $invoice['customer_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payment Status</b></td>
                                                    <td>: <?= $invoice['payment_status']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payment Due</b></td>
                                                    <td>: <?= $invoice['transaction_date']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($transactions as $trans) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $trans['product_name']; ?></td>
                                                        <td>RP <?= number_format($trans['price'], '0', ',', '.') ?></td>
                                                        <td><?= $trans['quantity']; ?></td>
                                                        <td>RP <?= number_format($trans['total_price'], '0', ',', '.') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>RP <?= number_format($invoice['total_transaction'], '0', ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tax</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping:</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>RP <?= number_format($invoice['total_transaction'], '0', ',', '.') ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-print">
                                    <div class="col-12">
                                        <button rel="noopener" class="btn btn-default float-right" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                                        <a href="<?= base_url('admin/transactions/listtransactions'); ?>" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-reply"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>