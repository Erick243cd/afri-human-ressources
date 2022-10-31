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
                            <h5 class="m-b-10">Catégories</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                            class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('categories-list')?>">Liste</a></li>
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
                        <?= form_open('add-category') ?>
                        <div class="row">
                            <div class="col-xl-8 col-md-8">
                                <h5>Titre</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Nom de la catégorie</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="category_name"
                                           value="<?= set_value('category_name') ?>">
                                    <small class="text-danger"><?= $validation['category_name'] ?? null ?></small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4">
                                <h5>Abréviation</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Abréviation</label>
                                    <input type="text" class="form-control" id="Text" placeholder=""
                                           name="short_name"
                                           value="<?= set_value('short_name') ?>">
                                    <small class="text-danger"><?= $validation['short_name'] ?? null ?></small>
                                </div>
                            </div>
                            <button class="btn btn-success ml-3" type="submit">Enregistrer</button>
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

