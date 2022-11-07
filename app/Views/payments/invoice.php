<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? "Afrinewsoft" ?></title>
    <link rel="icon" href="http://localhost/afri-human-ressources/public/assets/images/favicon.png" type="image/x-icon">
    <style>
        html, body {
            height: 180%;
            text-transform: uppercase;
        }

        .logo img {
            width: 110px;
            height: 80px;
        }

        .logo h3 {
            font-size: 18px;
            font-family: Arial, sans-serif;
            margin-top: 1px;
        }

        .header {
            border-radius: 5px;
            background-color: whitesmoke;
            margin-left: 50px;
            margin-bottom: 45px !important;
        }

        .qrcode {
            margin-left: 50px;
        }

        .qrcode img {
            width: 90px;
            height: 100px;
            padding-bottom: 20px;
        }

        .header h1 {
            font-family: Arial, sans-serif;
            font-size: 20px;
            padding-left: 10px;
            padding-right: 10px;
            letter-spacing: 8px;
        }

        .logo, .header, .qrcode {
            display: inline-block;
            position: relative;
            padding-bottom: 20px !important;
        }

        .header span {
            text-align: center;
            font-weight: bold;
            font-family: Arial, ui-sans-serif;
            font-size: 14px;
        }

        .general-info {
            background-color: #538aea;
            font-family: Arial, sans-serif;
            margin-top: -5px !important;
        }

        .general-info h3 {
            color: white;
            text-align: center;
            padding: 5px;
            margin-top: -15px;
            font-size: 15px;
        }

        .content-bloc {
            display: inline-block;
            position: relative;
            text-transform: uppercase;
            font-style: italic;
            margin-left: 20px;
            margin-right: -5px;
            font-family: Arial, "Arial Narrow", sans-serif;
            font-size: 12px;
            padding-bottom: 5px;
        }

        .content-bloc-perso {
            display: inline-block;
            position: relative;
            text-transform: uppercase;
            font-style: italic;
            margin-left: 15px;
            margin-right: -5px;
            font-family: Arial, "Arial Narrow", sans-serif;
            font-size: 12px;
            padding-bottom: 5px;
        }

        .content-bloc-perso span, strong {
            margin-bottom: 5px;
            padding-bottom: 10px;
        }

        .content-bloc-param {
            display: inline-block;
            position: relative;
            text-transform: uppercase;
            font-style: italic;
            margin-left: 30px;
            margin-right: -5px;
            font-family: Arial, "Arial Narrow", sans-serif;
            font-size: 12px;
            padding-bottom: 5px;
        }

        .perso-info {
            background-color: #538aea;
            font-family: Arial, sans-serif;
            margin-top: 15px;
        }

        .perso-info h3 {
            color: white;
            text-align: center;
            padding: 5px;
            margin-top: 0px;
            font-size: 15px;
        }

        .date-bloc {
            margin-top: 25px;
        }

        .date-bloc-element {
            display: inline-block;
            position: relative;
            text-transform: uppercase;
            font-style: italic;
            font-family: Arial, "Arial Narrow", sans-serif;
            font-size: 12px;
            padding-bottom: 5px;
        }

        .expirate-date {
            float: right;
            margin-right: 20px;
        }

        .evaluation-date {
            float: left;
            margin-left: 20px;
        }

        .adresses {
            width: 100%;
            text-transform: initial;
        }

        .physical, .email, .phone {
            margin-top: 10px;
            display: inline-block;
            position: relative;
            color: royalblue;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
    </style>

</head>
<body class="body-content">
<div class="logo">
    <img src="http://localhost/afri-human-ressources/public/logo-mountain-group.jpg">
    <h3>Mountain Group</h3>
</div>
<div class="header" style="text-align: center!important;">
    <h1>BULLETIN DE PAIE</h1>
    <span><?= $employee->firstName . '  ' . $employee->lastName ?></span>
</div>
<div class="qrcode">
    <img src="http://localhost/afri-human-ressources/public/assets/images/invoices/<?= $employee->id ?>.png">
</div>


<div class="general-info">
    <h3>INFORMATIONS GéNéRALES</h3>
</div>
<div class="content-general-info">
    <div class="content-bloc">
        <span>ENTREPRISE </span> <strong>MOUNTAIN GROUP</strong>
    </div>
    <div class="content-bloc">
        <span>SITE </span> <strong>LUBUMBASHI</strong>
    </div>
    <div class="content-bloc">
        <span>PROVINCE </span> <strong>HAUT KATANGA</strong>
    </div>
</div>

<div class="perso-info">
    <h3>INFORMATIONS PERSONNELLES</h3>
</div>
<div class="content-perso-info">
    <div class="content-bloc-perso">
        <span>PRéNOM </span> <strong><?= $employee->firstName ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>NOM </span> <strong><?= $employee->lastName ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>MATRICULE </span> <strong><?= $employee->matricule ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>SERVICE </span> <strong><?= $employee->serviceName ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>CATéGORIE </span> <strong><?= $employee->categoryName ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>Email </span> <strong><?= $employee->email ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>ADRESSE </span> <strong><?= $employee->address ?></strong>
    </div>
    <div class="content-bloc-perso">
        <span>TELEPHONE </span> <strong><?= $employee->phone ?></strong>
    </div>

    <div class="perso-info">
        <h3>INFORMATIONS DE PAIE</h3>
    </div>
    <div class="content-bloc">
        <span>MOIS</span> <strong><?= $payment->paymentMonth . '/' . $payment->yearName ?></strong>
    </div>
    <div class="content-bloc">
        <span>ANNEE </span> <strong><?= $payment->yearName ?></strong>
    </div>
    <div class="content-bloc">
        <span>NOMBRE DE JOURS PRESTES </span>
        <strong><?= $payment->daysWorked ?></strong>
    </div>
    <div class="content-bloc">
        <span>SALAIRE MOYEN JOURNALIER </span>
        <strong><?= number_format($employee->amountSmig, 2, ',', " ") . "USD" ?> </strong>
    </div>
</div>

<div class="perso-info">
    <h3>INDEMNITéS</h3>
</div>

<div class="content-perso-info">
    <div class="content-bloc-param">
        <span>LOGEMENT </span> <strong><?= number_format($payment->locationIndemnity, 2, ',', " ") . "USD" ?></strong>
    </div>
    <div class="content-bloc-param">
        <span>TRANSPORT </span> <strong><?= number_format($payment->transportIndemnity, 2, ',', " ") . "USD" ?></strong>
    </div>
</div>
<div class="perso-info">
    <h3>PRIMES ET AVANTAGES</h3>
</div>
<div class="content-perso-info">
    <div class="content-bloc-param">
        <span>PRIMES </span> <strong><?= number_format($payment->primes, 2, ',', " ") . "USD" ?></strong>
    </div>
    <div class="content-bloc-param">
        <span>AVANTAGES </span> <strong><?= number_format($payment->advantages, 2, ',', " ") . "USD" ?></strong>
    </div>
</div>

<div class="perso-info">
    <h3>CHARGES ET TAXES</h3>
</div>
<div class="content-perso-info">
    <div class="content-bloc-param">
        <span>SECURITé SOCIALE (CNSS) </span>
        <strong><?= number_format($payment->cnssQpo + $payment->cnssQpp, 2, ',', " ") . "USD" ?></strong>
    </div>
    <div class="content-bloc-param">
        <span>INPP </span> <strong><?= number_format($payment->inpp, 2, ',', " ") . "USD" ?></strong>
    </div>
    <div class="content-bloc-param">
        <span>ONEM </span> <strong><?= number_format($payment->onem, 2, ',', " ") . "USD" ?></strong>
    </div>
    <div class="content-bloc-param">
        <span>IPR </span> <strong><?= number_format($payment->ipr, 2, ',', " ") . "USD" ?></strong>
    </div>
</div>
<div class="perso-info" style="background-color: #5fa2ed!important;">
    <h3>SALAIRE NET</h3>
</div>
<div class="content-perso-info">
    <div class="content-bloc-param">
        <span>SALAIRE NET </span>
        <strong><?= number_format($payment->netSalary, 2, '.', ' ') . ' ', "USD" ?></strong>
    </div>
</div>
</body>
</html>
