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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editer le SMIG</h5>
                    </div>
                    <div class="card-body">
                        <?= form_open('edit-smig/' . $smig->smigId) ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-md-0 mb-sm-5">
                                <h5>Catégorie d'employé</h5>
                                <hr>
                                <select class="js-example-placeholder-multiple col-sm-12" name="categoryId">
                                    <option selected
                                            value="<?= $smig->categoryId ?>"<?= set_select('categoryId', $smig->categoryId); ?>>
                                        <?= $smig->categoryName ?>
                                    </option>
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
                                    <option selected
                                            value="<?= $smig->currency ?>"<?= set_select('categoryId', $smig->currency); ?>>
                                        <?= $smig->currency ?>

                                    <option value="USD" <?= set_select('currency', "USD"); ?>>USD</option>
                                    <option value="CDF" <?= set_select('currency', "CDF"); ?>>CDF</option>
                                </select>
                                <small class="text-danger"><?= $validation['currency'] ?? null ?></small>
                            </div>

                            <div class="col-sm-4">
                                <h5>Montant fixé</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Montant journalier fixé </label>
                                    <input type="text" name="smig_amount" class="form-control" id="Text" placeholder=""
                                           value="<?= (set_value('smig_amount')) ? set_value('smig_amount') : $smig->smig_amount ?><?= set_value('smig_amount') ?>">
                                </div>
                                <small class="text-danger"><?= $validation['smig_amount'] ?? null ?></small>
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn  btn-primary">Mettre à jour</button>
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
