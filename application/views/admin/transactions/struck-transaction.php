<center>
    <div class="row">
        <div class="col-12">
            <img src="<?= base_url('assets/'); ?>img/configuration/<?= $site['icon'] ?>" alt="Doi Logo" class="mb-2" width="30%">
            <h5 class="mb-0">
                <strong><?= $site['website_name'] ?></strong>
            </h5>
            <address>
                <?= $site['address'] ?><br>
                <?= $site['telephone'] ?>
            </address>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-top:1px dashed;">
                <table class="table mb-0">
                    <tr>
                        <td class="pl-0 pb-0">
                            Kasir<br>
                            Tanggal<br>
                            Invoice<br>
                            Table<br>
                            Customer<br>
                        </td>
                        <td class="pr-0 pb-0" align="right">
                            <?= $invoice['cashier']; ?><br>
                            <?= $invoice['transaction_date']; ?><br>
                            #<?= $invoice['transaction_code']; ?><br>
                            <?= $invoice['table_name']; ?><br>
                            <?= $invoice['customer_name']; ?><br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="border-bottom:1px dashed;margin-bottom:11px;margin-top:10px;">
    </div>
    <strong>### LUNAS ###</strong>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-top:1px dashed;margin-bottom:10px;margin-top:10px;padding-top:10px;">
                <table class="mb-0" width="100%">
                    <?php foreach ($transaction as $trans) : ?>
                        <tr>
                            <td class="pl-0 pb-0">
                                <?= $trans->product_name ?><br>
                                <?= number_format($trans->price, '0', ',', '.'); ?> x <?= $trans->quantity ?>
                            </td>
                            <td class="pr-0 pb-0" align="right">
                                <br>
                                <?= number_format($trans->total_price, '0', ',', '.'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" style="border-top:1px dashed;">
                <table width="100%">
                    <tr style="border-bottom:1px dashed;height:40px">
                        <td class="pl-0">Subtotal</td>
                        <td class="text-right pr-0">Rp <?= number_format($invoice['amount_paid'], '0', ',', '.'); ?></td>
                    </tr>
                    <tr style="border-bottom:1px dashed;height:40px">
                        <td class="pl-0">Total</td>
                        <td class="text-right pr-0">Rp <?= number_format($invoice['amount_paid'], '0', ',', '.'); ?></td>
                    </tr>
                    <tr style="border-bottom:1px dashed;height:60px">
                        <td class="pl-0">Cash<br>
                            Change</td>
                        <td class="text-right pr-0" id="struck-cash-change"><?= $cash ?><br>
                            <?= $change ?></td>
                    </tr>
                    <tr style="border-bottom:1px dashed;height:40px">
                        <td class="pl-0"><i class="fa fa-instagram"></i> doaibucoffee</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="pl-0">Notes<br>
                            <?= $site['tagline'] ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</center>