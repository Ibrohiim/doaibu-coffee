<section class="confirm-order banner2 bg5 p-t-55 p-b-55">
    <div class="container">
        <div class="alert alert-danger text-center" role="alert">
            <h4><strong>Please come to the cashier and show the order code! </strong></h4>
        </div>
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-3 m-l-r-auto p-t-15 p-b-15">
                <div class="block2-img wrap-pic-w of-hidden pos-relative pos-relative">
                    <img src="<?= base_url('assets/img/') ?>qrcode/<?= $confirmorder->qrcode; ?>" alt="<?= $confirmorder->transaction_code; ?>">
                </div>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto p-t-15 p-b-15">
                <section class="cart bgwhite p-t-15 p-b-15">
                    <div class="container">
                        <div class="bo9 p-l-15 p-r-15 p-t-20 p-b-20 p-lr-15-sm">
                            <div class="flex-w flex-sb-m p-t-5 p-b-8">
                                <span class="s-text18 w-size19 w-full-sm">
                                    Order Code
                                </span>
                                <span class="s-text13 w-size20 w-full-sm">
                                    <?= $confirmorder->transaction_code; ?>
                                </span>
                            </div>
                            <div class="flex-w flex-sb-m p-t-5 p-b-8">
                                <span class="s-text18 w-size19 w-full-sm">
                                    Table
                                </span>
                                <span class="s-text13 w-size20 w-full-sm">
                                    <?= $table->table_name; ?>
                                </span>
                            </div>
                            <div class="flex-w flex-sb-m p-t-5 p-b-8">
                                <span class="s-text18 w-size19 w-full-sm">
                                    Customer
                                </span>
                                <span class="s-text13 w-size20 w-full-sm">
                                    <?= $confirmorder->customer_name; ?>
                                </span>
                            </div>
                            <div class="flex-w flex-sb-m p-t-5 p-b-8">
                                <span class="s-text18 w-size19 w-full-sm">
                                    Order Date
                                </span>
                                <span class="s-text13 w-size20 w-full-sm">
                                    <?= $confirmorder->transaction_date; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-5 m-l-r-auto p-t-15 p-b-15">
                <section class="cart bgwhite p-t-15 p-b-15">
                    <div class="container">
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped table-responsive text-center" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th class="text-center s-text23">Product</th>
                                            <th class="text-center s-text23">Price</th>
                                            <th class="text-center s-text23">Quantity</th>
                                            <th class="text-center s-text23">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $c) {
                                            $id_product = $c->id_product;
                                            $product    = $this->products->detailProduct($id_product);
                                        ?>
                                            <tr class="table-row s-text7">
                                                <td><?= $product->product_name; ?></td>
                                                <td>Rp. <?= number_format($c->price, '0', ',', '.'); ?></td>
                                                <td>
                                                    <div>
                                                        <input class="size7 s-text7 t-center num-product" type="number" name="qty" value="<?= $c->quantity; ?>">
                                                    </div>
                                                </td>
                                                <td>Rp.
                                                    <?php
                                                    $subtotal = $c->price * $c->quantity;
                                                    echo number_format($subtotal, '0', ',', '.');
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        } ?>
                                        <tr>
                                            <th colspan="5" style="padding: 5px;"></th>
                                        </tr>
                                        <tr class="table-head bo9 bg6 s-text23">
                                            <th class="text-right" colspan="5">Total : Rp. <?= number_format($confirmorder->total_transaction, '0', ',', '.'); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>