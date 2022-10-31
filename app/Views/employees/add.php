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
                            <li class="breadcrumb-item"><a href="<?= site_url('employees-list') ?>">Liste</a></li>
                            <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Select2 ] start -->
            <div class="col-sm-12">
                <div class="card select-card">
                    <div class="card-body">
                        <?= form_open('add-employee') ?>
                        <div class="row">

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Matricule</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="emp_matricule"
                                           value="<?= set_value('emp_matricule') ?>">
                                    <small class="text-danger"><?= $validation['emp_matricule'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Prénom</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="emp_firstname"
                                           value="<?= set_value('emp_firstname') ?>">
                                    <small class="text-danger"><?= $validation['emp_firstname'] ?? null ?></small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Nom</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_lastname"
                                           value="<?= set_value('emp_lastname') ?>">
                                    <small class="text-danger"><?= $validation['emp_lastname'] ?? null ?></small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Service</h5>
                                <select class="js-example-placeholder-multiple col-sm-12" name="serviceId">
                                    <?php foreach ($services as $service) : ?>
                                        <option value="<?= $service->serviceId ?>"<?= set_select('serviceId', $service->serviceId); ?>>
                                            <?= $service->serviceName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= $validation['serviceId'] ?? null ?></small>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Catégorie d'employé</h5>
                                <select class="js-example-placeholder-multiple col-sm-12" name="categoryId">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category->categoryId ?>"<?= set_select('categoryId', $category->categoryId); ?>>
                                            <?= $category->categoryName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= $validation['categoryId'] ?? null ?></small>
                            </div>


                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Genre</h5>
                                <select class="js-example-placeholder-multiple col-sm-12" name="emp_gender">
                                    <option value="M" <?= set_select('emp_gender', "M"); ?>>M</option>
                                    <option value="F" <?= set_select('emp_gender', "F"); ?>>F</option>
                                </select>
                                <small class="text-danger"><?= $validation['emp_gender'] ?? null ?></small>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Téléphone</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_phone"
                                           value="<?= set_value('emp_phone') ?>">
                                    <small class="text-danger"><?= $validation['emp_phone'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Email</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_email"
                                           value="<?= set_value('emp_email') ?>">
                                    <small class="text-danger"><?= $validation['emp_email'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Adresse de résidence</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_location"
                                           value="<?= set_value('emp_location') ?>">
                                    <small class="text-danger"><?= $validation['emp_location'] ?? null ?></small>
                                </div>
                            </div>



                            <button class="btn btn-primary ml-3" type="submit">Enregistrer</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <!-- [ Select2 ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection() ?>



