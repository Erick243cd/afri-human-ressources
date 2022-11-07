<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">LISTING DE PAIE</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">App</a></li>
                            <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-12 text-right">
                                <form action="<?= site_url('payments-listing') ?>" class=""
                                      method="post">
                                    <select class="js-example-placeholder-multiple col-sm-2 mt-2" name="month">
                                        <option disabled selected
                                                value="<?= date('m') ?>" <?= set_select('month_name', date('m')); ?>>
                                            Sélectionner
                                        </option>
                                        <option value="01" <?= set_select('month_name', "01"); ?>>Janvier</option>
                                        <option value="02" <?= set_select('month_name', "02"); ?>>Février</option>
                                        <option value="03" <?= set_select('month_name', "03"); ?>>Mars</option>
                                        <option value="04" <?= set_select('month_name', "04"); ?>>Avril</option>
                                        <option value="05" <?= set_select('month_name', "05"); ?>>Mais</option>
                                        <option value="06" <?= set_select('month_name', "06"); ?>>Juin</option>
                                        <option value="07" <?= set_select('month_name', "07"); ?>>Juillet</option>
                                        <option value="08" <?= set_select('month_name', "08"); ?>>Août</option>
                                        <option value="09" <?= set_select('month_name', "09"); ?>>Septembre</option>
                                        <option value="10" <?= set_select('month_name', "10"); ?>>Octobre</option>
                                        <option value="11" <?= set_select('month_name', "11"); ?>>Novembre</option>
                                        <option value="12" <?= set_select('month_name', "12"); ?>>Décembre</option>
                                    </select>
                                    <select class="js-example-placeholder-multiple col-sm-2 mt-2" name="year">
                                        <?php foreach ($years as $row): ?>
                                            <option value="<?= $row->yearId ?>" <?= set_select('year', $row->yearId); ?>>
                                                <?= $row->yearName ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-md btn-round ml-2">Charger
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <!--       FLASH DATA                         -->
                            <?php if (session()->getFlashdata('success') !== null): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Matricule</th>
                                    <th>Département</th>
                                    <th>Catégorie</th>
                                    <th>Période</th>
                                    <th>Jours</th>
                                    <th>Salaire Net</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($payments as $row): ?>
                                    <tr>
                                        <td><?= $row->firstName . ' ' . $row->lastName ?></td>
                                        <td><?= $row->matricule ?></td>
                                        <td><?= $row->serviceName ?></td>
                                        <td><?= $row->categoryName ?></td>
                                        <td><?= $row->paymentMonth . '/' . $row->yearName ?></td>
                                        <td><?= $row->daysWorked ?></td>
                                        <td><?= number_format($row->netSalary, 2, ',', ' ') ?> $</td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>
                            <?php foreach ($massSalary as $row): ?>
                                <h4 class="text-right">Total: <?= number_format($row->netSalary, 2, ',', ' ') ?> $</h4>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- customar project  end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<?= $this->endSection() ?>

