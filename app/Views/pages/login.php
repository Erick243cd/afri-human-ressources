<?= $this->extend('pages/app') ?>
<?= $this->section('content') ?>
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                      data-kt-redirect-url="" action="<?= site_url('sign-in') ?>" method="post">
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">S'identifier</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Continuer Avec Vos Comptes</div>
                        <!--end::Subtitle=-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Login options-->
                    <div class="row g-3 mb-9">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Google link=-->
                            <a href="#"
                               class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo"
                                     src="<?= site_url() ?>public/assets/auth/media/svg/brand-logos/google-icon.svg"
                                     class="h-15px me-3"/>S'identifier avec Google</a>
                            <!--end::Google link=-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Google link=-->
                            <a href="#"
                               class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo"
                                     src="<?= site_url() ?>public/assets/auth/media/svg/brand-logos/apple-black.svg"
                                     class="theme-light-show h-15px me-3"/>
                                <img alt="Logo"
                                     src="<?= site_url() ?>public/assets/auth/media/svg/brand-logos/apple-black-dark.svg"
                                     class="theme-dark-show h-15px me-3"/>S'identifier avec Apple</a>
                            <!--end::Google link=-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Login options-->
                    <!--begin::Separator-->
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">Ou avec email</span>
                    </div>
                    <!--end::Separator-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email_adress" autocomplete="off"
                               class="form-control bg-transparent" value="<?= set_value('email_adress') ?>"/>
                        <small class="text-danger"><?= $validation['email_adress'] ?? null ?></small>
                        <!--end::Email-->
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-3">
                        <!--begin::Password-->
                        <input type="password" placeholder="Password" name="password" autocomplete="off"
                               class="form-control bg-transparent"/>
                        <small class="text-danger"><?= $validation['password'] ?? null ?></small>
                        <!--end::Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>
                        <!--begin::Link-->
                        <a href="<?= site_url('reset-password') ?>" class="link-primary">Mot de passe oublié ?</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">S'identifier</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">Je n'ai pas de compte?
                        <a href="<?= site_url('sign-up') ?>" class="link-primary">S'inscrire</a></div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
        <!--begin::Footer-->
        <?= $this->include('partials/footer') ?>
        <!--end::Footer-->
    </div>
<?= $this->endSection() ?>