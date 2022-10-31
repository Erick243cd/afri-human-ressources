<?= $this->extend('layouts/app')?>
<?= $this->section('content')?>
    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Photo Employé</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url('employees-list')?>"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Chargement de l'image</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ file-upload ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>File Upload</h5>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('add-employee-image/'.$employee->id, 'class="dropzone"')?>
                                <div class="fallback">
                                    <input name="employee_picture" type="file"/>
                                </div>
                                <span class="text-danger"><?= $validation['employee_picture'] ?? null ?></span>

                            <div class="text-center m-t-20">
                                <button type="submit" class="btn btn-primary">Charger Maintenant</button>
                            </div>
                            <?= form_close()?>
                        </div>
                    </div>
                </div>
                <!-- [ file-upload ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    <!-- [ Main Content ] end -->

<?= $this->endSection()?>