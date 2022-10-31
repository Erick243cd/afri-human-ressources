<?= $this->extend('pages/app') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
    <!--begin::Form-->
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form"
                  data-kt-redirect-url="/keen/demo3/../demo3/authentication/layouts/corporate/new-password.html"
                  action="#">
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">Mot de passe oublié ?</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-500 fw-semibold fs-6">Entrez votre e-mail pour réinitialiser votre mot de passe.</div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                           class="form-control bg-transparent"/>
                    <!--end::Email-->
                </div>
                <!--begin::Actions-->
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Soumettre</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                    <a href="<?= site_url()?>" class="btn btn-light">Annuler</a>
                </div>
                <!--end::Actions-->
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
