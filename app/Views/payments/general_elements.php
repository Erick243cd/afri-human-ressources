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
                            <h5 class="m-b-10">Paiement général</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('new-payment') ?>">Liste</a></li>
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
                        <h5>Paiement général</h5>
                    </div>
                    <div class="card-body">
                        <?= form_open('save-general-salary') ?>
                        <div class="row">
                            <div class="col-xl-6 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Année</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="year">
                                    <?php foreach ($years as $row) : ?>
                                        <option value="<?= $row->yearId ?>"><?= $row->yearName ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-md-2 mb-sm-5">
                                <h5>Mois</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="month">
                                    <?php foreach ($months as $row) : ?>
                                        <option value="<?= $row->taillyMonth ?>"><?= $row->taillyMonth ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Primes USD</label>
                                    <input type="number" step="any" name="prime_amount" class="form-control" id="Text"
                                           placeholder=""
                                           value="0" required>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Avantages USD</label>
                                    <input type="number" step="any" name="advantage_amount" class="form-control"
                                           id="Text" placeholder=""
                                           value="0" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn  btn-primary">Générer</button>
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


