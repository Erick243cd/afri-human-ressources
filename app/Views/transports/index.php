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
                            <h5 class="m-b-10">Taux de transport</h5>
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
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6 text-right">
                                <a class="btn btn-success btn-sm btn-round has-ripple"
                                   href="<?= site_url('add-taux') ?>"><i class="feather icon-plus"></i> Fixer
                                </a>
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
                                    <th>Année</th>
                                    <th>Mois</th>
                                    <th>Manager</th>
                                    <th>Simple Employé</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($taux as $row): ?>
                                    <tr>
                                        <td><?= $row->yearName ?></td>
                                        <td><?= $row->tauxMonth ?></td>
                                        <td><?= number_format($row->amountManager, 2, ',', ' ') ?> USD</td>
                                        <td><?= number_format($row->amountSimpleEmployee, 2, ',', ' ') ?> USD</td>
                                        <td>
                                            <span class="<?= $row->status == 1 ? 'text-success bg-light' : 'text-danger' ?>"><?= $row->status == 1 ? 'Actif' : 'Inactif' ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('edit-taux/' . $row->tauxId) ?>"
                                               class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                            <?php if ($row->status == 0): ?>
                                                <a title="Marquer comme taux courant"
                                                   onclick="return confirm('Marquer comme taux courant ?');"
                                                   href="<?= site_url('active-taux/' . $row->tauxId) ?>"
                                                   class="btn btn-sm btn-success"><i
                                                            class="fas fa-check">
                                                    </i></a>&nbsp;
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
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



