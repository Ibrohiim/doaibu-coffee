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
            <div class="row">
                <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daily Report</h3>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/reportsstatistics/dailyreports'); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <select name="date" id="date" class="form-control">
                                            <?php
                                            $start = 1;
                                            for ($i = $start; $i < $start + 31; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <select name="month" id="month" class="form-control">
                                            <?php
                                            $start = 1;
                                            for ($i = $start; $i < $start + 12; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select name="year" id="year" class="form-control">
                                            <?php
                                            $start = date('Y') - 2;
                                            for ($i = $start; $i < $start + 10; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block"><i class="fas fa-print"></i> Print Report</button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Report</h3>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/reportsstatistics/monthreports'); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <select name="month" id="month" class="form-control">
                                            <?php
                                            $start = 1;
                                            for ($i = $start; $i < $start + 12; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select name="year" id="year" class="form-control">
                                            <?php
                                            $start = date('Y') - 2;
                                            for ($i = $start; $i < $start + 10; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block"><i class="fas fa-print"></i> Print Report</button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Annual Report</h3>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/reportsstatistics/yearreports'); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select name="year" id="year" class="form-control">
                                            <?php
                                            $start = date('Y') - 2;
                                            for ($i = $start; $i < $start + 10; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block"><i class="fas fa-print"></i> Print Report</button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>