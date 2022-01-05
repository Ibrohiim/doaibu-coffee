<style type="text/css">
    @media print {

        header,
        .footer,
        footer {
            display: none;
        }

        .content {
            margin-top: 50px;
        }
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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/reportsstatistics') ?>"> <?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $subtitle; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="<?= base_url('admin/reportsstatistics'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                    </div>
                    <div class="invoice p-3 mb-3 mt-2">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-fw fa-file-invoice"></i> <?= $subtitle; ?>
                                    <small class="float-right">Year: <?= $year; ?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Transaction Code</th>
                                            <th>Transaction Date</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $grand_total = 0;
                                        foreach ($yearreports as $yr) :
                                            $grand_total = $grand_total + $yr->total_transaction;
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $yr->transaction_code; ?></td>
                                                <td><?= $yr->transaction_date; ?></td>
                                                <td>Rp. <?= number_format($yr->total_transaction, 0); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">Grand Total : </th>
                                            <th>Rp. <?= number_format($grand_total, 0); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>