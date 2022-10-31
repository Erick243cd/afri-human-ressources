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
                            <h5 class="m-b-10">Employé</h5>
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
                        <?= form_open('edit-employee/'.$employee->id) ?>
                        <div class="row">

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Matricule</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="emp_matricule"
                                           value="<?= (set_value('emp_matricule')) ? set_value('emp_matricule') : $employee->matricule ?>">
                                    <small class="text-danger"><?= $validation['emp_matricule'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Prénom</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="emp_firstname"
                                           value="<?= (set_value('emp_firstname')) ? set_value('emp_firstname') : $employee->firstName ?>">
                                    <small class="text-danger"><?= $validation['emp_firstname'] ?? null ?></small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Nom</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_lastname"
                                           value="<?= (set_value('emp_lastname')) ? set_value('emp_lastname') : $employee->lastName ?>">
                                    <small class="text-danger"><?= $validation['emp_lastname'] ?? null ?></small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Service</h5>
                                <select class="js-example-placeholder-multiple col-sm-12" name="serviceId">
                                    <option selected
                                            value="<?= $employee->serviceId ?>"<?= set_select('serviceId', $employee->serviceId); ?>>
                                        <?= $employee->serviceName ?>

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
                                    <option selected
                                            value="<?= $employee->categoryId ?>"<?= set_select('categoryId', $employee->categoryId); ?>>
                                        <?= $employee->categoryName ?>
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
                                    <option selected
                                            value="<?= $employee->gender ?>"<?= set_select('emp_gender', $employee->gender); ?>>
                                        <?= $employee->gender ?>
                                    <option value="M" <?= set_select('emp_gender', "M"); ?>>M</option>
                                    <option value="F" <?= set_select('emp_gender', "F"); ?>>F</option>
                                </select>
                                <small class="text-danger"><?= $validation['emp_gender'] ?? null ?></small>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Téléphone</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_phone"
                                           value="<?= (set_value('emp_phone')) ? set_value('emp_phone') : $employee->phone ?>">
                                    <small class="text-danger"><?= $validation['emp_phone'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Email</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_email"
                                           value="<?= (set_value('emp_email')) ? set_value('emp_email') : $employee->email ?>">
                                    <small class="text-danger"><?= $validation['emp_email'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Adresse de résidence</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="emp_location"
                                           value="<?= (set_value('emp_location')) ? set_value('emp_location') : $employee->address ?>">
                                    <small class="text-danger"><?= $validation['emp_location'] ?? null ?></small>
                                </div>
                            </div>


                            <button class="btn btn-primary ml-3" type="submit">Mettre à jour</button>
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



