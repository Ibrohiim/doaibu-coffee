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
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/transactions/listtransactions') ?>"><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/transactions/sales') ?>">Add New Transaction</a></li>
                    </ul>
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Transactions</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Code</th>
                                        <th>Type</th>
                                        <th>Table</th>
                                        <th>Customer</th>
                                        <th>Payment status</th>
                                        <th>Cashier</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($transaction as $trans) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $trans['transaction_code']; ?></td>
                                            <td><?= $trans['order_type']; ?></td>
                                            <td><?= $trans['table_name']; ?></td>
                                            <td><?= $trans['customer_name']; ?></td>
                                            <td><?= $trans['payment_status']; ?></td>
                                            <td><?= $trans['cashier']; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" style="min-width: 6em;">
                                                        <a class="btn btn-primary btn-sm mb-2 ml-1" href="<?= base_url('admin/transactions/detailtransaction/') . $trans['transaction_code']; ?>"><i class='fas fa-info-circle'></i> Detail</a>
                                                        <a class="btn btn-danger btn-sm ml-1 button-delete" href="<?= base_url('admin/transactions/deletetransaction/') . $trans['transaction_code']; ?>"><i class='fa fa-trash'></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Code</th>
                                        <th>Type</th>
                                        <th>Table</th>
                                        <th>Customer</th>
                                        <th>Payment status</th>
                                        <th>Cashier</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>