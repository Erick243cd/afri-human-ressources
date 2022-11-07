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
                            <h5 class="m-b-10">TAUX DE TRANSPORT</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('taux-list') ?>">Liste</a></li>
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
                        <?= form_open('update-taux/' . $taux->tauxId) ?>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-md-0 mb-sm-5">
                                <h5>Année</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="year_id">
                                    <option value="<?= $taux->yearId ?>"<?= set_select('year_id', $taux->yearId); ?>>
                                        <?= $taux->yearName ?>

                                        <?php foreach ($years

                                        as $row) : ?>
                                    <option value="<?= $row->yearId ?>"<?= set_select('year_id', $row->yearId); ?>>
                                        <?= $row->yearName ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= $validation['year_id'] ?? null ?></small>
                            </div>

                            <div class="col-xl-6 col-md-6 mb-md-0 mb-sm-5">
                                <h5>Mois</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="month_name">

                                    <option value="<?= $taux->tauxMonth ?>" <?= set_select('month_name', $taux->tauxMonth); ?>><?= $taux->tauxMonth ?></option>


                                    <option value="01" <?= set_select('month_name', "01"); ?>>Janvier</option>
                                    <option value="02" <?= set_select('month_name', "02"); ?>>Février</option>
                                    <option value="03" <?= set_select('month_name', "03"); ?>>Mars</option>
                                    <option value="04" <?= set_select('month_name', "04"); ?>>Avril</option>
                                    <option value="05" <?= set_select('month_name', "05"); ?>>Mais</option>
                                    <option value="06" <?= set_select('month_name', "06"); ?>>Juin</option>
                                    <option value="07" <?= set_select('month_name', "07"); ?>>Juillet</option>
                                    <option value="08" <?= set_select('month_name', "08"); ?>>Août</option>
                                    <option value="09" <?= set_select('month_name', "09"); ?>>Septembre</option>
                                    <option value="10" <?= set_select('month_name', "10"); ?>>Octobre</option>
                                    <option value="11" <?= set_select('month_name', "11"); ?>>Novembre</option>
                                    <option value="12" <?= set_select('month_name', "12"); ?>>Décembre</option>
                                </select>
                                <small class="text-danger"><?= $validation['month_name'] ?? null ?></small>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <h5>Manager</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Montant journalier fixé USD</label>
                                    <input type="number" step="any" class="form-control" id="Text" placeholder=""
                                           name="manager_amount"
                                           value="<?= (set_value('manager_amount')) ? set_value('manager_amount') : $taux->amountManager ?>">
                                    <small class="text-danger"><?= $validation['manager_amount'] ?? null ?></small>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <h5>Simple employé </h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Montant journalier fixé USD</label>
                                    <input type="number" step="any" class="form-control" id="Text" placeholder=""
                                           name="simple_amount"
                                           value="<?= (set_value('simple_amount')) ? set_value('simple_amount') : $taux->amountSimpleEmployee ?>">
                                    <small class="text-danger"><?= $validation['simple_amount'] ?? null ?></small>
                                </div>
                            </div>

                            <button class="btn btn-success ml-3" type="submit">Mettre à jour</button>
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



