<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pointages</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('employees-list') ?>">Liste</a></li>
                            <li class="breadcrumb-item"><a href="#!">Carte de service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- liveline-section start -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if (session()->getFlashdata('success') !== null): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error') !== null): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form class="d-flex justify-content-center mb-4 mt-2">
                            <!-- Default input -->
                            <input type="search" placeholder="Rechercher l'employé" aria-label="Search"
                                   class="form-control"
                                   id="search_employe">
                        </form>
                        <div class="row" id="result-employe">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection('content') ?>
