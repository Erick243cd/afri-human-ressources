<?= $this->extend('layouts/app')?>
<?= $this->section('content')?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url()?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?= $title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-flask f-36 text-c-yellow"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Services</h6>
                                <h2 class="m-b-0"><?= $services ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-user-md f-36 text-c-purple"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Catégories</h6>
                                <h2 class="m-b-0"><?= $categories ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-user-injured f-36 text-c-red"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Employés</h6>
                                <h2 class="m-b-0"><?= $employees ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-user-nurse f-36 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Femmes</h6>
                                <h2 class="m-b-0"><?= $women ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-user-tie f-36 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Hommes</h6>
                                <h2 class="m-b-0"><?= $men ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-file-invoice-dollar f-36 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Primes</h6>
                                <h2 class="m-b-0">00</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-file-invoice-dollar f-36 text-c-red"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Allocations</h6>
                                <h2 class="m-b-0">00</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fas fa-users f-36 text-c-purple"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Utilisateurs</h6>
                                <h2 class="m-b-0"><?= $users ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

<?= $this->endSection()?>

