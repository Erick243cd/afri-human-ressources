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
                            <li class="breadcrumb-item"><a href="#!">App</a></li>
                            <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card user-profile-list">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <a href="<?= site_url('add-category') ?>" class="btn btn-sm btn-primary float-right mr-2 mb-1">Nouvelle
                                catégorie</a>
                            <!--       FLASH DATA                         -->
                            <?php if (session()->getFlashdata('success') !== null): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <table id="user-list-table" class="table nowrap">
                                <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categories as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <div class="d-inline-block">
                                                    <h6 class="m-b-0"><?= $row->categoryName ?></h6>
                                                    <p class="m-b-0"><?= $row->createdAt ?></p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-light-success">Active</span>
                                            <div class="overlay-edit">
                                                <a href="<?= site_url('edit-category/' . $row->categoryId) ?>"
                                                   class="btn btn-icon btn-success"><i
                                                            class="feather icon-check-circle"></i></a>
                                                <a href="<?= site_url('delete-category/' . $row->categoryId) ?>"
                                                   onclick="return confirm('Etes-vous sûr de supprimer cette catégorie ?');"
                                                   class="btn btn-icon btn-danger"><i
                                                            class="feather icon-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                <tr>
                                    <th>Titre</th>
                                    <th></th>
                                </tr>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<?= $this->endSection() ?>
