<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
<head>
    <title><?= $title ?? "Afrinewsoft | Login - Human Ressources Management" ?></title>
    <meta charset="utf-8"/>
    <meta name="description" content="Human Ressources Management Application, by Afrinewsoft"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="<?= site_url() ?>public/favicon.png"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="<?= site_url() ?>public/assets/auth/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?= site_url() ?>public/assets/auth/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->

<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center"
             style="background-image: url(<?= site_url() ?>public/assets/auth/media/misc/auth-bg.png)">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-0 w-100">
                <!--begin::Logo-->
                <a href="<?= site_url() ?>" class="mb-0 mb-lg-20">
                    <img alt="Logo" src="<?= site_url() ?>public/assets/auth/media/logos/favicon.svg"
                         class="h-40px h-lg-175px"/>
                </a>
                <!--end::Logo-->
                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-400px mb-5 mb-lg-5"
                     src="<?= site_url() ?>public/assets/auth/media/misc/afri-auth-sreen.png" alt="Screen"/>
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Gestion des ressources
                    humaines</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center mb-10">Ce logiel conçu par
                    <a href="https://afrinewsoft.com" target="_blank"
                       class="opacity-75-hover text-warning fw-semibold me-1">afrinewsoft</a>contient tous les modules
                    liés à la GRH. Vous pouvez désormais gérer les agents, les pointages, la paie, les affectations, la
                    planification, etc.
                    </a>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
                <?= $this->renderSection("content")?>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "<?= site_url()?>";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= site_url() ?>public/assets/auth/plugins/global/plugins.bundle.js"></script>
<script src="<?= site_url() ?>public/assets/auth/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= site_url() ?>public/assets/auth/js/custom/authentication/sign-in/general.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>

