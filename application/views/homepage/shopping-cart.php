<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
</section>

<!-- Cart -->
<section class="banner2 p-t-55 p-b-55">
    <div class="container">
        <div id="flash" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-7 m-l-r-auto p-t-15 p-b-15">
                <div class="wrap-table-shopping-cart bgwhite" id="mytable">
                    <div class="card">
                        <div class="card-header bo9 bg6 text-center">
                            <h5 class="card-title m-text20" style="margin-bottom: 0px;">Order</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped text-center" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th style="padding: 5px;"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center s-text23">Product</th>
                                        <th class="text-center s-text23">Price</th>
                                        <th class="text-center s-text23">Quantity</th>
                                        <th class="text-center s-text23">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $c) {
                                        $id_product = $c['id'];
                                        $product    = $this->products->detailProduct($id_product);
                                        $total_bt[] = $c['qty'] * $c['bursttime'];

                                        echo form_open(base_url('homepage/updatecart/' . $c['rowid']));
                                    ?>
                                        <tr class="table-row s-text7">
                                            <td><?= $c['name']; ?></td>
                                            <td>Rp. <?= number_format($c['price'], '0', ',', '.'); ?></td>
                                            <td>
                                                <div>
                                                    <input class="size7 t-center num-product s-text7" type="number" name="qty" value="<?= $c['qty']; ?>">
                                                </div>
                                            </td>
                                            <td>Rp.
                                                <?php
                                                $subtotal = $c['price'] * $c['qty'];
                                                echo number_format($subtotal, '0', ',', '.');
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        echo form_close();
                                    } ?>
                                    <tr>
                                        <th colspan="5" style="padding: 5px;"></th>
                                    </tr>
                                    <tr class="table-head bo9 bg6 s-text23">
                                        <input type="hidden" value="<?= !empty($total_bt) ? array_sum($total_bt) : null ?>" name="total_bt" id="total-bt">
                                        <th class="text-right" colspan="5">SubTotal : Rp. <?= number_format($this->cart->total(), '0', ',', '.'); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-5 m-l-r-auto p-t-15 p-b-15">
                <div class="card" id="formconfirm">
                    <div class="card-header bo9 bg6 text-center">
                        <h5 class="card-title m-text20" style="margin-bottom: 0px;">Confirm Order</h5>
                    </div>
                    <div class="bo9 p-l-40 p-r-40 p-t-10 p-b-38 m-r-0 p-lr-15-sm text-center">
                        <?= $this->session->flashdata('message'); ?>
                        <form role="form" action="<?= base_url('homepage/checkout') ?>" method="POST">
                            <?php $transaction_code = date('dmY') . strtoupper(random_string('alnum', 10)); ?>
                            <input type="hidden" class="form-control" id="total_transaction" name="total_transaction" value="<?= $this->cart->total(); ?>">
                            <input type="hidden" class="form-control" id="transaction_date" name="transaction_date" value="<?= date('Y-m-d H:i:s'); ?>">
                            <div class="flex-w flex-sb p-t-15 p-b-0">
                                <div class="w-full text-left">
                                    <div class="s-text23 p-b-5">
                                        Order Code
                                    </div>
                                    <div class="size25 bo4 m-b-12">
                                        <input class="bg6 sizefull s-text7 p-l-15 p-r-15" type="text" id="transaction_code" name="transaction_code" value="<?= $transaction_code ?>" readonly>
                                    </div>
                                    <div class="s-text23 p-b-5">
                                        Order Type
                                    </div>
                                    <div class="size25 bo4 m-b-12">
                                        <input class="bg6 sizefull s-text7 p-l-15 p-r-15" type="text" id="ordertype" name="ordertype" value="<?= $this->session->userdata('ordertype') ?>" readonly>
                                    </div>
                                    <div class="s-text23 p-b-5 <?= form_error('table_number') ? 'text-danger' : null; ?>">
                                        Table Number
                                    </div>
                                    <div class="rs2-select2 of-hidden m-b-12">
                                        <select class="form-control sizefull s-text7 p-l-15 p-r-15 <?= form_error('customer_name') ? 'is-invalid' : null; ?>" name="table_number" id="table_number">
                                            <option>Select table</option>
                                            <?php foreach ($table as $t) : ?>
                                                <option value="<?= $t['table_code']; ?>"><?= $t['table_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="s-text23 p-b-5 <?= form_error('customer_name') ? 'text-danger' : null; ?>">
                                        Firstname
                                    </div>
                                    <div class="size25 bo4 m-b-12">
                                        <input type="text" value="<?= set_value('customer_name'); ?>" name="customer_name" placeholder="Input your name" id="customer_name" class="form-control sizefull s-text7 p-l-15 p-r-15 <?= form_error('customer_name') ? 'is-invalid' : null; ?>" />
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($this->cart->contents())) { ?>
                                <div class="row">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="size15" style="height: 40px;">
                                            <button type="submit" value="submit" class="flex-c-m sizefull bg1 bo-rad-10 hov1 s-text1 trans-0-4">
                                                Proceed to Checkout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <p>Empty shopping cart. Please order first! <a href="<?= base_url('homepage/products') ?>"><b>Order?</b></a></p>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>