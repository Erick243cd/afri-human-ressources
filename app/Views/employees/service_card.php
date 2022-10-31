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
                                <h5 class="m-b-10">Carte de service</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>"><i
                                                class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= site_url('employees-list') ?>">Liste</a></li>
                                <li class="breadcrumb-item"><a href="#!">Carte de service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row justify-content-center">
                <!-- liveline-section start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <h5><?= ucfirst($employee->firstName . ' ' . $employee->lastName) ?></h5>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?= site_url('add-employee') ?>" class="btn btn-primary btn-sm"><i
                                                class="feather icon-plus"></i>Nouvel Employé
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body pt-0">
                            <div class="user-about-block text-center">
                                <div class="row align-items-end">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80"
                                                          src="<?= site_url() ?>public/assets/images/employees/<?= $employee->profilePicture ?>"
                                                          alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?= site_url('edit-employee/'.$employee->id)?>">Edit</a>
                                                <a class="dropdown-item" href="<?= site_url('add-employee-image/'.$employee->id)?>">Image</a>
<!--                                                <a class="dropdown-item" href="#">Trash</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3"><?= $employee->firstName . ' ' . $employee->lastName ?>
                                        </h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="fas fa-check-circle"> </i> <?= $employee->categoryName ?></p>
                                <p class="mb-1"><b>Email : </b><a
                                            href="mailto:<?= $employee->email ?>"><?= $employee->email ?></a></p>
                                <p class="mb-0"><b>Service : </b><?= $employee->serviceName ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="<?= site_url()?>public/assets/images/employees/qrcodes/<?= $employee->id?>.png" alt="" class="img-fluid w-50">
                            <hr>
                        </div>
                    </div>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="First"><small class="text-danger">* </small>First
                                    Name</label>
                                <input type="text" class="form-control" id="Name" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Last"><small class="text-danger">* </small>Last
                                    Name</label>
                                <input type="text" class="form-control" id="Last" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Email"><small class="text-danger">* </small>Email
                                    Address</label>
                                <input type="email" class="form-control" id="Email" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Password"><small class="text-danger">* </small>New
                                    Password</label>
                                <input type="password" class="form-control" id="Password" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Membership"><small class="text-danger">* </small>Change
                                    Membership</label>
                                <select class="form-control" id="Membership">
                                    <option value=""></option>
                                    <option value="2">Bronze</option>
                                    <option value="3">Gold</option>
                                    <option value="4">Platinum</option>
                                    <option value="5">Silver</option>
                                    <option value="1">Trial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label class="floating-label" for="Extend">Extend Membership</label>
                                <input type="date" class="form-control" id="Extend" placeholder="123">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="d-block mb-2">Status</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                       class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadioInline1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="customRadioInline1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">Pending</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline4" name="customRadioInline1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">Banned</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="d-block mb-2 mt-3">User Type</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline2"
                                       class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadioInline21">Staff</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline2"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline22">Editor</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="customRadioInline2"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline23">Member</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="d-block mb-2">Newsletter Subscriber</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline3"
                                       class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadioInline31">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline3"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline32">No</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="d-block mb-2">Send Email Notification</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">
                                    <Yes></Yes>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mt-3">
                                <label class="floating-label" for="Note">User Note</label>
                                <textarea class="form-control" id="Note" rows="6" spellcheck="false"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"> Save</button>
                    <button class="btn btn-danger"> Clear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
<?= $this->endSection() ?>