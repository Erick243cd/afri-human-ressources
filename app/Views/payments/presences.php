<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Employé</h5>
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
        <div class="row help-desk">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <nav class="navbar justify-content-between p-0 align-items-center">
                            <h5><?= $employee->firstName . ' ' . $employee->lastName ?></h5>

                            <form class="d-flex justify-content-between" method="post"
                                  action="<?= site_url('presences-list/' . $employee->id) ?>">
                                <select class="form-control" name="yearSearch">
                                    <option value="">Année</option>
                                    <?php foreach ($periods as $row): ?>
                                        <option value="<?= $row->taillyYear ?>" <?= set_select('yearSearch', $row->taillyYear) ?>><?= $row->taillyYear ?></option>
                                    <?php endforeach; ?>

                                </select>

                                <select class="form-control" name="monthSearch">
                                    <option value="" selected>Mois</option>
                                    <?php foreach ($periods as $row): ?>
                                        <option value="<?= $row->taillyMonth ?>" <?= set_select('monthSearch', $row->taillyMonth) ?>><?= ucfirst(dateToFrench(date('F', strtotime($row->taillyDate)), 'F')) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="submit" class="btn btn-sm btn-primary" value="charger">
                            </form>
                        </nav>
                    </div>
                </div>
                <div class="ticket-block">
                    <div class="row">
                        <div class="col-auto">
                            <img class="media-object wid-60 img-radius"
                                 src="<?= site_url() ?>public/assets/images/employees/<?= $employee->profilePicture ?>"
                                 alt="Generic placeholder image">
                        </div>
                        <div class="col">
                            <div class="card hd-body">
                                <div class="row align-items-center">
                                    <div class="col border-right pr-0">
                                        <div class="card-body inner-center">
                                            <div class="ticket-customer font-weight-bold"><?= $employee->firstName . ' ' . $employee->lastName ?></div>
                                            <div class="ticket-type-icon private mt-1 mb-1"><i
                                                        class="feather icon-lock mr-1 f-14"></i><?= $employee->categoryName ?>
                                            </div>
                                            <ul class="list-inline mt-2 mb-0">
                                                <li class="list-inline-item">
                                                    <img src="<?= site_url() ?>public/assets/images/ticket/p1.jpg"
                                                         alt=""
                                                         class="wid-20 rounded mr-1 img-fluid"><?= $employee->serviceName ?>
                                                </li>
                                            </ul>
                                            <div class="mt-2">
                                                <a href="<?= site_url('invoice-card-employee/' . $employee->id) ?>"
                                                   class="mr-3 text-muted"><i
                                                            class="feather icon-eye mr-1"></i>Bulletin de paie</a>
                                                <a href="<?= site_url('service-card-employee/' . $employee->id) ?>"
                                                   class="text-danger"><i
                                                            class="feather icon-edit mr-1"></i>Carte de service</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto pl-0 right-icon">
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="tooltip on top" class="active"><i
                                                                class="feather icon-star text-warning"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="tooltip on top"><i
                                                                class="feather icon-circle text-muted"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="right-side">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Présences</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="cat-list">
                                <div class="border-bottom pb-3 ">
                                    <div class="d-inline-block">
                                        <img src="<?= site_url() ?>public/assets/images/ticket/p1.jpg" alt=""
                                             class="wid-20 rounded mr-1 img-fluid">
                                        <a href="#">Total</a>
                                    </div>
                                    <div class="float-right span-content">
                                        <a href="#"
                                           class="btn waves-effect waves-light btn-default badge-danger rounded-circle mr-0 "
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="tooltip on top"><?= count($point_data) ?></a>
                                    </div>
                                </div>
                                <?php foreach ($point_data as $row): ?>

                                    <div class="border-bottom pb-3 ">
                                        <div class="d-inline-block">
                                            <a href="#"><?= dateToFrench($row->taillyDate, 'd, M Y') ?></a>
                                        </div>
                                        <div class="float-right span-content">
                                            <a href="#"
                                               class="btn waves-effect waves-light btn-default badge-primary rounded-circle mr-0 "
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="tooltip on top"><?= $row->taillyPoint ?></a>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<?= $this->endSection() ?>

