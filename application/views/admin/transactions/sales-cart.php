<div class="card-body p-0">
    <table class="table table-striped" id="table-transactions">
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Total price</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php if (!empty($invoice)) { ?>
            <tbody>
                <input type="hidden" <?= $i = 1; ?>>
                <?php if (!empty($transaction)) {
                    foreach ($transaction as $trans) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $trans->product_code ?></td>
                            <td><?= $trans->product_name ?></td>
                            <td>Rp <?= number_format($trans->price, '0', ',', '.'); ?></td>
                            <td><?= $trans->quantity ?></td>
                            <td><?= $trans->current_discount ?></td>
                            <td>Rp <?= number_format($trans->total_price, '0', ',', '.'); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-success btn-sm" href="<?= base_url('/') . $trans->id_transaction; ?>"><i class="fas fa-sync-alt"></i></a>
                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('/') . $trans->id_transaction; ?>"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                } else { ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } else { ?>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>