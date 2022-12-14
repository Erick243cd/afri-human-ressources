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
                            <h5 class="m-b-10">Utilisateurs</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('users-list')?>">Liste</a></li>
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
                            <a href="<?= site_url('add-user')?>" class="btn btn-sm btn-primary float-right mr-2 mb-1">Ajouter utilisateur</a>
                            <!--       FLASH DATA                         -->
                            <?php if (session()->getFlashdata('success') !== null): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <table id="user-list-table" class="table nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>R??le</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <img src="<?= site_url('public/assets/images/user/'.$row->user_image) ?>"
                                                     alt="user image" class="img-radius align-top m-r-15"
                                                     style="width:40px;">
                                                <div class="d-inline-block">
                                                    <h6 class="m-b-0"><?= $row->user_name ?></h6>
                                                    <p class="m-b-0"><?= $row->user_email ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= ucfirst($row->user_role) ?></td>
                                        <td><?= ($row->user_role !== 1) ? 'Online':'Offline' ?></td>
                                        <td>
                                            <span class="badge badge-light-success">Active</span>
                                            <div class="overlay-edit">
                                                <a href="<?= site_url('edit-user/'.$row->user_id)?>" class="btn btn-icon btn-success"><i
                                                            class="feather icon-check-circle"></i></a>
                                                <a href="<?= site_url('delete-user/'.$row->user_id)?>" onclick="return confirm('Etes-vous s??r de supprimer cet utilisateur ?');" class="btn btn-icon btn-danger"><i
                                                            class="feather icon-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>R??le</th>
                                    <th>Status</th>
                                    <th></th>
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
