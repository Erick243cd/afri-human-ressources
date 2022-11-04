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
                            <h5 class="m-b-10">Paramètres</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('payments-list') ?>">Liste</a></li>
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
                        <h5><?= $employee->firstName . ' ' . $employee->lastName ?></h5>
                    </div>
                    <div class="card-body">
                        <?= form_open('edit-smig/' . $employee->id) ?>
                        <div class="row">

                            <div class="col-xl-6 col-md-6 mb-md-0 mb-sm-5">
                                <h5>Annee</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="year">
                                    <option selected value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                    <?php foreach ($years as $row) : ?>
                                        <option value="<?= $row->taillyYear ?>"><?= $row->taillyYear ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-md-0 mb-sm-5">
                                <h5>Mois</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="year">
                                    <option selected value="<?= date('m') ?>"><?= date('m') ?></option>
                                    <?php foreach ($months as $row) : ?>
                                        <option value="<?= $row->taillyMonth ?>"><?= $row->taillyMonth ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Primes</label>
                                    <input type="number" step="any" name="prime_amount" class="form-control" id="Text"
                                           placeholder=""
                                           value="<?= $payment !== null ? $payment->primes : 0 ?>">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Avantages</label>
                                    <input type="number" step="any" name="advantage_amount" class="form-control"
                                           id="Text" placeholder=""
                                           value="<?= $payment !== null ? $payment->advantages : 0 ?>">
                                </div>
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

