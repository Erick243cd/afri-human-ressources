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
                            <h5 class="m-b-10">Utilisateurs</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">CDL</a></li>
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
                        <?= form_open('add-user') ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Rôle</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="user_role">
                                    <option value="Admin" selected <?= set_select('category', 'Admin', false); ?>>
                                        Admin
                                    </option>
                                    <option value="DRH" <?= set_select('category', 'DRH', false); ?>>
                                        DRH
                                    </option>

                                    <option value="Autre" <?= set_select('Autre', 'Autre', false); ?>>Autre</option>
                                </select>
                                <small class="text-danger"><?= $validation['user_role'] ?? null ?></small>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <h5>Nom d'utilisateur</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="username"
                                           value="<?= set_value('username') ?>">
                                    <small class="text-danger"><?= $validation['username'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <h5>Adresse mail</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Adresse mail</label>
                                    <input type="text" class="form-control" id="Text" placeholder="" name="email_adress"
                                           value="<?= set_value('email_adress') ?>">
                                    <small class="text-danger"><?= $validation['email_adress'] ?? null ?></small>
                                </div>
                            </div>
                            <button class="btn btn-success ml-3" type="submit">Enregistrer</button>
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

