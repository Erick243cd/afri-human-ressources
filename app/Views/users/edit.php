<?= $this->extend("layouts/app") ?>
<?= $this->section("content") ?>
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
                                <li class="breadcrumb-item"><a href="#!">Afrinewsoft</a></li>
                                <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Editer l'utilisateur</h5>
                        </div>
                        <div class="card-body">
                            <?= form_open('edit-user/' . $user->user_id) ?>
                            <div class="row">
                                <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                    <h5>Rôle</h5>
                                    <hr>
                                    <select class="js-example-placeholder-multiple col-sm-12" name="userRole">
                                        <option selected
                                                value="<?= $user->user_role ?>" <?= set_select('userRole', $user->user_role, true) ?>><?= $user->user_role ?></option>
                                        <option value="Admin" <?= set_select('userRole', 'Admin', false); ?>>
                                            Admin
                                        </option>
                                        <option value="DRH" <?= set_select('userRole', 'DRH', false); ?>>
                                            DRH
                                        </option>

                                        <option value="Autre" <?= set_select('userRole', 'Autre', false); ?>>Autre
                                        </option>
                                    </select>
                                    <small class="text-danger"><?= $validation['userRole'] ?? null ?></small>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Nom Utilisateur</h5>
                                    <hr>
                                    <div class="form-group">
                                        <label class="floating-label" for="Text">Nom Utilisateur</label>
                                        <input type="text" name="userName" class="form-control" id="Text" placeholder=""
                                               value="<?= (set_value('userName')) ? set_value('userName') : $user->user_name ?><?= set_value('userName') ?>">
                                    </div>
                                    <small class="text-danger"><?= $validation['userName'] ?? null ?></small>
                                </div>

                                <div class="col-sm-4">
                                    <h5>Adresse mail</h5>
                                    <hr>
                                    <div class="form-group">
                                        <label class="floating-label" for="Email">Addresse mail</label>
                                        <input type="email" name="emailAdress" class="form-control" id="Email"
                                               aria-describedby="emailHelp"
                                               value="<?= (set_value('emailAdress')) ? set_value('emailAdress') : $user->user_email ?>">
                                    </div>
                                    <small class="text-danger"><?= $validation['emailAdress'] ?? null ?></small>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn  btn-primary">Enregistrer</button>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

<?= $this->endSection() ?>