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
                            <h5 class="m-b-10">SMIG</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('smigs-list') ?>">Liste</a></li>
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
                        <?= form_open('add-smig') ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Catégorie d'employé</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="categoryId">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category->categoryId ?>"<?= set_select('categoryId', $category->categoryId); ?>>
                                            <?= $category->categoryName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= $validation['categoryId'] ?? null ?></small>
                            </div>

                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Devise</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="currency">
                                    <option value="USD" <?= set_select('currency', "USD"); ?>>USD</option>
                                    <option value="CDF" <?= set_select('currency', "CDF"); ?>>CDF</option>
                                </select>
                                <small class="text-danger"><?= $validation['currency'] ?? null ?></small>
                            </div>

                            <div class="col-xl-4 col-md-4">
                                <h5>SMIG</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Montant journalier fixé</label>
                                    <input type="number" step="any" class="form-control" id="Text" placeholder=""
                                           name="smig_amount"
                                           value="<?= set_value('smig_amount') ?>">
                                    <small class="text-danger"><?= $validation['smig_amount'] ?? null ?></small>
                                </div>
                            </div>

                            <button class="btn btn-success ml-3" type="submit">Fixer</button>
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


