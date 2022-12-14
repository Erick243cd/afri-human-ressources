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
                            <h5 class="m-b-10">Employés</h5>
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
                                <a class="btn btn-primary btn-sm btn-round has-ripple"
                                   href="<?= site_url('add-employee') ?>"><i class="feather icon-plus"></i> Ajouter
                                </a>
                                <a class="btn btn-danger btn-sm btn-round has-ripple"
                                   href="#!"><i class="fas fa-upload"></i> Importer
                                </a>
                                <a class="btn btn-success btn-sm btn-round has-ripple"
                                   href="<?= site_url('export-employees') ?>"><i class="fas fa-file-export"></i>
                                    Exporter
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
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Matricule</th>
                                    <th>Catégorie</th>
                                    <th>Service</th>
                                    <th>Salaire de base</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($employees as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <a href="<?= site_url('add-employee-image/' . $row->id) ?>"
                                                   title="Changer l'image"><img
                                                            src="<?= site_url('public/assets/images/employees/' . $row->profilePicture) ?>"
                                                            alt="user image" class="img-radius align-top m-r-15"
                                                            style="width:40px;"></a>
                                            </div>
                                        </td>
                                        <td><?= $row->firstName . ' ' . $row->lastName ?></td>
                                        <td><?= $row->matricule ?></td>
                                        <td><?= $row->categoryName ?></td>
                                        <td><?= $row->serviceName ?></td>
                                        <td><?= number_format($row->amountSmig, 2, ',', ' ') ?> $</td>
                                        <td>
                                            <a href="<?= site_url('edit-employee/' . $row->id) ?>"
                                               class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                            <a onclick="return confirm('Cette action est irreversible, voulez-vous continuer ?');"
                                               href="<?= site_url('delete-employee/' . $row->id) ?>"
                                               class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>&nbsp;
                                            <a href="<?= site_url('service-card-employee/' . $row->id) ?>"
                                               class="btn btn-sm btn-primary"><i class="fas fa-user-check"></i></a>
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


