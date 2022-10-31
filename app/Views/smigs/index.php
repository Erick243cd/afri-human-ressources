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
                            <h5 class="m-b-10">SMIG</h5>
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
                                   href="<?= site_url('add-smig') ?>"><i class="feather icon-plus"></i> Fixer
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
                                    <th>Catégorie d'employé</th>
                                    <th>Smig fixé</th>
                                    <th>Devise</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($smigs as $row): ?>
                                    <tr>
                                        <td><?= $row->categoryName ?></td>
                                        <td><?= $row->smig_amount ?></td>
                                        <td><?= $row->currency ?></td>

                                        <td>
                                            <a href="<?= site_url('edit-smig/' . $row->smigId) ?>"
                                               class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                            <a onclick="return confirm('Cette action est irreversible, voulez-vous continuer ?');" href="<?= site_url('delete-smig/' . $row->smigId) ?>"
                                               class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>&nbsp;

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


