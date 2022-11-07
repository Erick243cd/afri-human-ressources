<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Afrinewsoft | Human Ressources Management</title>
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
    <meta name="description" content=""/>
    <meta name="keywords" content="">
    <meta name="author" content="Afrinewsoft"/>
    <!-- Favicon icon -->
    <link rel="icon" href="<?= site_url() ?>public/assets/images/favicon.png" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?= site_url() ?>public/assets/css/style.css">


</head>
<!-- [ offline-ui ] start -->
<div class="auth-wrapper maintance">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <img src="<?= site_url() ?>public/assets/images/maintenance/404.png" alt="" class="img-fluid">
                    <h5 class="text-muted my-4">Oops! Page non retrouvée !</h5>
                    <p> <?= $msg ?? '' ?></p>
                    <form action="">
                        <a href="<?= site_url() ?>" class="btn waves-effect waves-light btn-primary mb-4"><i
                                    class="feather icon-refresh-ccw mr-2"></i>Recharger
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ offline-ui ] end -->
<!-- Required Js -->
<script src="<?= site_url() ?>public/assets/js/vendor-all.min.js"></script>
<script src="<?= site_url() ?>public/assets/js/plugins/bootstrap.min.js"></script>
</body>
</html>
