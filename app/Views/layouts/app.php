<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $title . ' | Afrinewsoft' ?></title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Human Ressources Management Application, by Afrinewsoft"/>
    <meta name="keywords" content="">
    <meta name="author" content="Afrinewsoft"/>
    <!-- Favicon icon -->
    <link rel="icon" href="<?= site_url() ?>public/assets/images/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- select2 css -->
    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/plugins/select2.min.css">

    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/plugins/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/plugins/bootstrap-tagsinput-typeahead.css">


    <!-- vendor css -->
    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/style.css">

    <?php if (isset($page) && $page === 'add-employee-image'): ?>
        <!-- fileupload-custom css -->
        <!--        <link rel="stylesheet" href="--><? //= site_url()?><!--public/assets/css/plugins/dropzone.min.css">-->
    <?php endif; ?>


</head>
<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius"
                         src="<?= site_url() ?>public/assets/images/user/<?= $sess_data->user_image ?>"
                         alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details"><?= ucfirst($sess_data->user_role) ?> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="<?= site_url('user-profile') ?>"
                               data-toggle="tooltip"
                               title="Voir Profile"><i class="feather icon-user"></i></a></li>
                        <li class="list-inline-item">
                            <a href="<?= site_url('logout') ?>"
                               data-toggle="tooltip"
                               title="Logout"
                               class="text-danger"><i class="feather icon-power"></i></a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    <ul class="pcoded-submenu">

                        <li class="pcoded-hasmenu"><a href="#!">Employés</a>
                            <ul class="pcoded-submenu">
                                <li><a href="<?= site_url('add-employee') ?>">Ajouter</a></li>
                                <li><a href="<?= site_url('employees-list') ?>">Liste</a></li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu"><a href="#!">Pointages</a>
                            <ul class="pcoded-submenu">
                                <li><a href="<?= site_url('add-appointment') ?>">Nouveau</a></li>
                                <li><a href="<?= site_url('appointments-list') ?>">Liste </a></li>
                                <li><a href="<?= site_url('absents-list') ?>">Absences</a></li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu"><a href="#!">Paie</a>
                            <ul class="pcoded-submenu">
                                <li><a href="<?= site_url('new-payment') ?>">Nouvelle</a></li>
                                <li><a href="#!">Allocations</a></li>
                                <li><a href="#!">Primes</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-settings"></i></span><span
                                class="pcoded-mtext">Configurations</span></a>
                    <ul class="pcoded-submenu">
                        <?php if ($sess_data->user_role === 'Admin') : ?>
                            <li class="pcoded-hasmenu"><a href="#!">Utilisateurs</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="<?= site_url('add-user') ?>">Ajouter</a></li>
                                    <li><a href="<?= site_url('users-list') ?>">Liste</a></li>
                                </ul>
                            </li>
                            <li class="pcoded-hasmenu"><a href="#!">Catégories</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="<?= site_url('add-category') ?>">Ajouter</a></li>
                                    <li><a href="<?= site_url('categories-list') ?>">Liste</a></li>
                                </ul>
                            </li>

                            <li class="pcoded-hasmenu"><a href="#!">Smigs</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="<?= site_url('add-smig') ?>">Fixer</a></li>
                                    <li><a href="<?= site_url('smigs-list') ?>">Liste</a></li>
                                </ul>
                            </li>
                            <li class="pcoded-hasmenu"><a href="#!">Taux Transport</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="<?= site_url('add-taux') ?>">Fixer</a></li>
                                    <li><a href="<?= site_url('taux-list') ?>">Liste</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <li><a href="<?= site_url('user-profile') ?>">Profile</a></li>
                        <?php if ($sess_data->user_role === 'Médecin Examinateur' || $sess_data->user_role === 'Médecin Vérificateur') : ?>
                            <li><a href="<?= site_url('add-signature') ?>">Signature</a></li>
                        <?php endif; ?>
                        <li><a href="<?= site_url('logout') ?>">Logout</a></li>
                    </ul>
                </li>

            </ul>

            <div class="card text-center">
                <div class="card-block">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="feather icon-sunset f-40"></i>
                    <h6 class="mt-3">Besoin d'aide ?</h6>
                    <p>Contactez-nous svp par mail ou par whatsapp</p>
                    <a href="https://afrinewsoft.com/contact" target="_blank"
                       class="btn btn-primary btn-sm text-white m-0">Support</a>
                </div>
            </div>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">

    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="assets/images/logo.png" alt="" class="logo">

        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Rechercher ici">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="<?= site_url() ?>public/assets/images/user/<?= $sess_data->user_image ?>"
                                 class="img-radius" alt="User-Profile-Image">
                            <span><?= $sess_data->user_name ?></span>
                            <a href="<?= site_url('logout') ?>" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li>
                                <a href="<?= site_url('user-profile') ?>" class="dropdown-item"><i
                                            class="feather icon-user"></i>Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</header>
<!-- [ Header ] end -->


<?= $this->renderSection("content") ?>
<!-- Warning Section start -->
<!-- Older IE warning message -->
<!--[if lt IE 11]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade
        <br/>to any of the following web browsers to access this website.
    </p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (11 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Js -->
<script src="<?= site_url() ?>public/assets/js/vendor-all.min.js"></script>
<script src="<?= site_url() ?>public/assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= site_url() ?>public/assets/js/ripple.js"></script>
<script src="<?= site_url() ?>public/assets/js/pcoded.min.js"></script>
<script src="<?= site_url() ?>public/assets/js/menu-setting.min.js"></script>

<!-- custom-chart js -->
<script src="<?= site_url() ?>public/assets/js/pages/dashboard-crm.js"></script>

<script src="<?= site_url() ?>public/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?= site_url() ?>public/assets/js/plugins/dataTables.bootstrap4.min.js"></script>

<script src="<?= site_url() ?>public/assets/js/plugins/select2.full.min.js"></script>
<!-- form-select-custom Js -->
<script src="<?= site_url() ?>public/assets/js/pages/form-select-custom.js"></script>
<!-- Apex Chart -->
<script src="<?= site_url() ?>public/assets/js/plugins/apexcharts.min.js"></script>
<!-- select2 Js -->
<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>
<?php
if (isset($page) && $page === 'tailly' || isset($page) && $page === 'taillies') {
    echo $this->include('layouts/ajax');
}
?>

</body>

</html>
