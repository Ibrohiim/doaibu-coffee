<style type="text/css">
    @media screen {
        #printSection {
            display: none;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printSection,
        #printSection * {
            visibility: visible;
        }

        #printSection {
            position: relative;
            left: 0;
            top: 0;
        }

        header,
        .footer,
        footer {
            display: none;
        }
    }
</style>
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
            <form class="form-horizontal" method="POST" action="<?= base_url('admin/transactions/transactionprocess'); ?>" id="transaction-form">
                <div class="row">
                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <div class="card card-outline">
                            <div class="card-body" style="padding: 10px">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="">Date</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="datetime" class="form-control" id="transaction-date" name="transaction_date" value="<?= !empty($invoice['transaction_date']) ? $invoice['transaction_date'] : date('l, d-M-Y  h:i:s a'); ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="">Cashier</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="text" class="form-control" id="cashier" name="cashier" value="<?= $user['name'] ?>" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="order_type">Order Type</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <?php if (!empty($invoice['order_type'])) { ?>
                                                    <input type="text" class="form-control" value="<?= $invoice['order_type']; ?>" name="order_type" id="order-type" readonly>
                                                <?php } else { ?>
                                                    <select class="form-control" id="order-type" name="order_type">
                                                        <option value="Dine In">Dine In</option>
                                                        <option value="Take Away">Take Away</option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <div class="card card-outline">
                            <div class="card-body" style="padding: 10px">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="table">Table</label>
                                        </td>
                                        <td>
                                            <?php if (!empty($invoice['table_number'])) { ?>
                                                <div class="form-group" style="margin-bottom: 5px;">
                                                    <input type="text" class="form-control" value="<?= $invoice['table_name']; ?>" name="table_number" placeholder="Table Number" id="table-number" readonly>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group" style="margin-bottom: 5px;">
                                                    <select class="form-control" id="table-number" name="table_number">
                                                        <option value="0">
                                                            Please select one
                                                        </option>
                                                        <?php if (isset($table) && is_array($table)) { ?>
                                                            <?php foreach ($table as $tab) { ?>
                                                                <option value="<?= $tab['table_code']; ?>">
                                                                    <?= $tab['table_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="customer">Customer</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="text" class="form-control" value="<?= !empty($invoice['customer_name']) ? $invoice['customer_name'] : ''; ?>" name="customer_name" id="customer-name" placeholder="Customer Name" <?= !empty($invoice['customer_name']) ? 'readonly' : ''; ?>>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="total_customers">Total Cust</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="text" class="form-control" value="<?= !empty($invoice['total_customers']) ? $invoice['total_customers'] : ''; ?>" name="total_customers" id="total-customers" placeholder="Total Customers" <?= !empty($invoice['total_customers']) ? 'readonly' : ''; ?> disabled>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <div class="card card-outline" id="code-paid">
                            <div class="card-body" style="padding: 10px" id="code-paid-content">
                                <div align="right">
                                    <input type="hidden" class="form-control" id="transaction-code" name="transaction_code" value="<?= !empty($transaction['transaction_code']) ? $invoice['transaction_code'] : $transaction_code; ?>" />
                                    <h5>Invoice <b><span><?= !empty($transaction['transaction_code']) ? $invoice['transaction_code'] : $transaction_code; ?></span></b></h5>
                                    <h1><b><span>Rp <?php if ($transaction) {
                                                        echo number_format($invoice['amount_paid'], '0', ',', '.');
                                                    } elseif ($this->cart->contents()) {
                                                        echo number_format($this->cart->total(), '0', ',', '.');
                                                    } else {
                                                        echo '.0';
                                                    }; ?>
                                            </span></b></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Category</td>
                                            <td>Menu Name</td>
                                            <td>Quantity</td>
                                            <td>Unit Price</td>
                                            <td>Discount</td>
                                            <td>Total Price</td>
                                            <td>Input Menu</td>
                                        </tr>
                                    </thead>
                                    <tbody id="transaction">
                                        <tr>
                                            <td>
                                                <select class="form-control" id="sale-category" name="category_id">
                                                    <option value="0">
                                                        Please select one
                                                    </option>
                                                    <?php if (isset($categories) && is_array($categories)) { ?>
                                                        <?php foreach ($categories as $item) { ?>
                                                            <option value="<?php echo $item->id; ?>">
                                                                <?php echo $item->category_name; ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" value="<?= !empty($transaction['transaction_code']) ? $invoice['transaction_code'] : $transaction_code; ?>" id="transaction_code" name="transaction_code" class="form-control" />
                                                <input type="hidden" class="form-control" id="transaction_date" name="transaction_date" value="<?= date('Y-m-d H:i:s'); ?>">
                                                <select class="form-control" id="sale-product" name="product_id"></select>
                                            </td>
                                            <td>
                                                <input type="number" id="quantity" class="form-control" name="quantity" min="1" value="1" style="width: 100px;" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-price-format discount-trx" id="sale-price" name="sale_price" placeholder="Price" style="width: 120px;" required />
                                            </td>
                                            <td>
                                                <input type="number" value="0" min="0" max="100" class="form-control discount-trx" id="discount" name="discount" style="width: 100px;" placeholder="Discount" />
                                                <input type="hidden" class="form-control discount-trx" id="bursttime" name="bursttime" style="width: 100px;" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="total-price" name="total_price" style="width: 120px;" placeholder="Total price" />
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary <?= !empty($transaction) ? 'add-menu' : 'add-cart'; ?>" id="add"><i class="fa fa-cart-plus"></i> Add</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline" id="cart-transactions">
                            <div class="card-body p-0" id="cart-transactions-content">
                                <table class="table table-striped" id="table-transactions">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Total price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="transaction-data">
                                        <?php
                                        $i = 1;
                                        $ii = 1;
                                        if (!empty($transaction)) {
                                            foreach ($transaction as $trans) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $trans->product_name ?></td>
                                                    <td>Rp <?= number_format($trans->price, '0', ',', '.'); ?></td>
                                                    <td>
                                                        <input type="number" class="form-control" id="qty" name="qty" value="<?= $trans->quantity ?>" style="width: 50px;">
                                                    </td>
                                                    <td><?= $trans->current_discount ?></td>
                                                    <td>Rp <?= number_format($trans->total_price, '0', ',', '.'); ?></td>
                                                    <td>
                                                        <button type="button" data-id="<?= $trans->id_transaction ?>" data-name="<?= $trans->product_name ?>" class="btn btn-danger btn-sm transaction-delete-item"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                            $items = $this->cart->contents();
                                        } else if (!empty($items) && is_array($items)) {
                                            foreach ($items as $items) :
                                                $id_product = $items['id'];
                                                $product    = $this->products->detailProduct($id_product);
                                                $total_bt[] = $items['qty'] * $items['bursttime'];
                                            ?>
                                                <tr>
                                                    <td><?= $ii++; ?></td>
                                                    <td><?= $items['name'] ?></td>
                                                    <td>Rp <?= number_format($items['price'], '0', ',', '.'); ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <input type="number" class="form-control text-center" id="qty-cart<?= $items['rowid'] ?>" name="qty_cart" value="<?= $items['qty'] ?>" style="width: 50px;height: 25px;padding: 0px 2px;font-size: 13px;font-weight: 800;">
                                                            <button type="button" data-id="<?= $items['rowid'] ?>" data-name="<?= $items['name'] ?>" class="btn btn-sm update-cart-item p-0 ml-2" style="color:#28a745;"><i class="fas fa-sync-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td><?= $product->current_discount ?></td>
                                                    <td>Rp <?= number_format($items['subtotal'], '0', ',', '.'); ?></td>
                                                    <td>
                                                        <button type="button" data-id="<?= $items['rowid'] ?>" data-name="<?= $items['name'] ?>" class="btn btn-sm delete-cart-item p-0" style="color:#dc3545;"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        } else { ?>
                                            <td colspan="7">
                                                <div class="alert alert-warning alert-dismissible">
                                                    No orders have been received yet.
                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-outline" id="total-transactions">
                            <div class="card-body" style="padding: 10px" id="total-transactions-content">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="sub_total">Sub Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="text" class="form-control form-price-format" value="Rp <?= !empty($invoice['amount_paid']) ? number_format($invoice['amount_paid'], '0', ',', '.') : number_format($this->cart->total(), '0', ',', '.'); ?>" name="sub_total" id="sub-total" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="discount">Discount</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 8px;">
                                                <input type="number" class="form-control" id="total-discount" name="total_discount" placeholder="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="grand_total">Grand Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="text" class="form-control form-price-format" value="Rp. <?= !empty($invoice['amount_paid']) ? number_format($invoice['amount_paid'], '0', ',', '.') : number_format($this->cart->total(), '0', ',', '.'); ?>" readonly>
                                                <input type="hidden" class="form-control cash-transaction" value="<?= !empty($invoice['amount_paid']) ? $invoice['amount_paid'] : $this->cart->total(); ?>" name="grand_total" id="grand-total" readonly>
                                                <input type="hidden" class="form-control" value="<?php
                                                                                                    if (!empty($invoice['total_bursttime'])) {
                                                                                                        echo $invoice['total_bursttime'];
                                                                                                    } elseif (!empty($total_bt)) {
                                                                                                        echo array_sum($total_bt);
                                                                                                    } ?>" name="total_bursttime" id="total-bursttime" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-outline">
                            <div class="card-body" style="padding: 10px">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="cash">Cash</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 8px;">
                                                <input type="number" class="form-control cash-transaction" id="cash" name="cash">

                                                <input type="hidden" class="form-control form-price-format" id="cash-struck" name="cash-struck">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <label for="change">Change</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 8px;">
                                                <input type="text" class="form-control" id="change" name="change" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-outline">
                            <div class="card-body" style="padding: 10px">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="note">Note</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 8px;">
                                                <textarea class="form-control" rows="3" placeholder="Enter ..." id="note" name="note"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <a href="<?= base_url('admin/transactions/canceltransaction') ?>" class="btn btn-warning btnPrint"><i class="fas fa-sync-alt"></i> Cancel
                            </a><br><br>
                            <button type="button" class="btn btn-success" id="submit-transaction" disabled><i class="fas fa-paper-plane"></i> Process Payment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="modal fade" id="struckModal" tabindex="-1" role="dialog" aria-labelledby="struckModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="struckModalTitle">Transaction is successful</h5>
            </div>
            <div class="modal-body">
                <center>
                    <strong>Transaction successful. Print receipt?</strong>
                </center>
                <div id="printSection">
                    <div class="invoice p-3 mb-3 printSection" id="struck-transaction">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('admin/transactions') ?>" class="btn btn-info float-left">Scan</a>
                <a href="<?= base_url('admin/transactions/canceltransaction') ?>" class="btn btn-secondary">Close</a>
                <button type="button" class="btn btn-success" id="btnPrintStruck"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>