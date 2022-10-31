<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <!-- profile header start -->
        <div class="user-profile user-card mb-4">
            <div class="card-header border-0 p-0 pb-0">
                <div class="cover-img-block">
                    <!-- <img src="assets/images/profile/cover.jpg" alt="" class="img-fluid"> -->
                    <div class="overlay"></div>
                    <div class="change-cover">
                        <div class="dropdown">
                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><i class="icon feather icon-camera"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload
                                    new</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-film mr-2"></i> upload
                                    video</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-0">
                <div class="user-about-block m-0">
                    <div class="row">
                        <div class="col-md-4 text-center mt-n5">
                            <div class="change-profile text-center">
                                <div class="dropdown w-auto d-inline-block">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <div class="profile-dp">
                                            <div class="position-relative d-inline-block">
                                                <img class="img-radius img-fluid wid-100"
                                                     src="<?= site_url('public/assets/images/user/' . $sess_data->user_image) ?>"
                                                     alt="User image">
                                            </div>
                                            <div class="overlay">
                                                <span>change</span>
                                            </div>
                                        </div>
                                        <div class="certificated-badge">
                                            <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                            <i class="fas fa-check front-icon text-white"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload
                                            new</a>
                                        <a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from
                                            photos</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-1"><?= ucfirst($sess_data->user_name) ?></h5>
                            <p class="mb-2 text-muted"><?= ucfirst($sess_data->user_role) ?></p>
                        </div>
                        <div class="col-md-8 mt-md-4">
                            <div class="row">
                                <div class="col-md-6">

                                    <a href="mailto:<?= $sess_data->user_email ?>"
                                       class="mb-1 text-muted d-flex align-items-end text-h-primary"><i
                                                class="feather icon-mail mr-2 f-18"></i><?= $sess_data->user_email ?>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <i class="feather icon-user-check mr-2 mt-1 f-18"></i>
                                        <div class="media-body">

                                            <p class="mb-0 text-muted mt-1">
                                                <?= $sess_data->user_role ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-reset active" id="profile-tab" data-toggle="tab"
                                       href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i
                                                class="feather icon-user mr-2"></i>Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-reset" id="home-tab" data-toggle="tab" href="#home"
                                       role="tab" aria-controls="home" aria-selected="true"><i
                                                class="feather icon-home mr-2"></i>Accueil</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profile header end -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <!-- profile body start -->
        <div class="row">
            <div class="col-md-12 order-md-2">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="font-weight-normal"><a href="#!" class="text-h-primary text-reset"><b
                                                class="font-weight-bolder">
                                            <?= ucfirst($sess_data->user_name) ?></b></a>, Vous êtes sur votre profile
                                </h5>
                                <p class="mb-0 text-muted"><?= $sess_data->user_role ?></p>
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item full-card"><a href="#!"><span><i
                                                                class="feather icon-maximize"></i> maximize</span><span
                                                            style="display:none"><i class="feather icon-minimize"></i> Restore</span></a>
                                            </li>
                                            <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                                class="feather icon-minus"></i> collapse</span><span
                                                            style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                            </li>
                                            <li class="dropdown-item reload-card"><a href="#!"><i
                                                            class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="#!"><i
                                                            class="feather icon-trash"></i> remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="#!"><img src="assets/images/profile/bg-1.jpg" alt="" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Informations personnelles</h5>
                                <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right"
                                        data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false"
                                        aria-controls="pro-det-edit-1 pro-det-edit-2">
                                    <i class="feather icon-edit"></i>
                                </button>
                            </div>
                            <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nom
                                            d'utilisateur</label>
                                        <div class="col-sm-9">
                                            <?= ucfirst($sess_data->user_name) ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Adresse Mail</label>
                                        <div class="col-sm-9">
                                            <?= $sess_data->user_email ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Mot de passe</label>
                                        <div class="col-sm-9">
                                            xxxxxxxxx
                                        </div>
                                    </div>
                                    <?php if ($sess_data->user_signature !== null): ?>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bolder">Signature</label>
                                            <div class="col-sm-9">
                                                <img src="<?= site_url() ?>public/assets/images/signatures/<?= $sess_data->user_signature ?>"
                                                     alt="Signature" width="130" height="80">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                            <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
                                <?= form_open('update-user') ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nom d'utilisateur</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="userName"
                                               placeholder="Nom d'utilisateur"
                                               value="<?= (set_value('userName')) ? set_value('userName') : $sess_data->user_name ?>">
                                    </div>
                                    <small class="text-danger"><?= $validation['userName'] ?? null ?></small>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Adresse mail</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="emailAdress"
                                               placeholder="Adresse mail"
                                               value="<?= (set_value('emailAdress')) ? set_value('emailAdress') : $sess_data->user_email ?>">
                                        <small class="text-danger"><?= $validation['emailAdress'] ?? null ?></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nouveau mot de
                                        passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="userPassword" class="form-control"
                                               placeholder="Nouveau mot de passe"
                                               value="<?= (set_value('userPassword')) ? set_value('userPassword') : "" ?>">
                                        <small class="text-danger"><?= $validation['userPassword'] ?? null ?></small>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Confirmer mot de
                                        passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="passwordConfirm" class="form-control"
                                               placeholder="Confirmer mot de passe" value="">
                                        <small class="text-danger"><?= $validation['passwordConfirm'] ?? null ?></small>
                                    </div>
                                </div>
                                <input type="hidden" name="userID" value="<?= $sess_data->user_id ?>">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- profile body end -->
    </div>
</div>
<?= $this->endSection() ?>
