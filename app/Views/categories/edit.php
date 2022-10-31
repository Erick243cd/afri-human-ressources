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
                            <h5 class="m-b-10">Catégorie</h5>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editer la catégorie</h5>
                    </div>
                    <div class="card-body">
                        <?= form_open('edit-category/' . $category->categoryId) ?>
                        <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <h5>Titre</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Titre de la catégorie</label>
                                    <input type="text" name="category_name" class="form-control" id="Text" placeholder=""
                                           value="<?= (set_value('category_name')) ? set_value('category_name') : $category->categoryName ?><?= set_value('category_name') ?>">
                                </div>
                                <small class="text-danger"><?= $validation['category_name'] ?? null ?></small>
                            </div>

                            <div class="col-sm-4">
                                <h5>Abréviation</h5>
                                <hr>
                                <div class="form-group">
                                    <label class="floating-label" for="Email">Abréviation</label>
                                    <input type="text" name="short_name" class="form-control" id="Email"
                                           aria-describedby="emailHelp"
                                           value="<?= (set_value('short_name')) ? set_value('short_name') : $category->shortName ?>">
                                </div>
                                <small class="text-danger"><?= $validation['short_name'] ?? null ?></small>
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