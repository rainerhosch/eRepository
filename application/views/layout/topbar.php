<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url('assets/template') ?>/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    <?= $this->session->userdata('fullname'); ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <?php if ($this->session->userdata('role') === '1' || $this->session->userdata('role') === '2') : ?>
                    <a href="#profile" class="dropdown-item notify-item btn_edit_profile">
                        <i class="fe-user"></i>
                        <span>Edit Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>
                <a href="<?= base_url('auth'); ?>/logout" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
        <li>
            <h4 class="page-title-main"><?php
                                        echo $page;
                                        if (isset($subpage)) {
                                            echo '<i class="mdi mdi-triangle-wave"></i>' . $subpage;
                                        }; ?>
            </h4>
        </li>
    </ul>
    <!-- LOGO -->
    <div class="logo-box">
        <h3 href="#" class="logo text-center" style="margin:0px; color:#fff;">
            <span class="logo-sm">
                <!-- <img src="<?= base_url('assets/template') ?>/images/logo-sm.png" alt="" height="22"> -->
                <strong>
                    <i class="dripicons-store"></i>
                </strong>
            </span>
            <span class="logo-lg">
                <!-- <img src="<?= base_url('assets/template') ?>/images/logo-light.png" alt="" height="16"> -->
                <strong height="16"><i class="dripicons-store"></i> e-Library </strong>
            </span>
        </h3>
        <a href="#" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="<?= base_url('assets/template') ?>/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('assets/template') ?>/images/logo-dark.png" alt="" height="16">
            </span>
        </a>
    </div>
    <div class="clearfix"></div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit_user" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nama_user" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="user_id" name="user_id">
                            <input type="hidden" class="form-control" id="user_detail_id" name="user_detail_id">
                            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama Lengkap" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="alamat_user" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="email_user" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="tlp_user" class="col-sm-4 col-form-label">No Tlp</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tlp_user" name="tlp_user" placeholder="No Tlp/Handphone" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="change_password" class="col-sm-4 col-form-label">Ubah Password</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Default select" id="ubah_password">
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-1 div_password" hidden>
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="password_lama" name="password_lama" value="" required>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary btn_save_role_user" style="float: right;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btn_edit_profile').on('click', function() {
            var user_id = `<?= $this->session->userdata('user_id') ?>`;
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>manajemen/user/getDataById",
                data: {
                    id: user_id
                },
                dataType: "json",
                success: function(response) {
                    let data_user = response.data;
                    console.log(data_user)
                    $('#user_id').val(data_user.user_id)
                    $('#user_detail_id').val(data_user.user_detail_id)
                    $('#nama_user').val(data_user.nama)
                    $('#alamat_user').val(data_user.alamat)
                    $('#email_user').val(data_user.email)
                    $('#tlp_user').val(data_user.tlp)
                    $('#password_lama').val(data_user.password)
                    $('#exampleModal').modal('show');

                    $('#ubah_password').on('change', function() {
                        let data = $(this).val();
                        console.log(data)
                        if (data === '2') {
                            $('.div_password').prop('hidden', false);
                            $('#password_baru').prop('disabled', false);
                            $('#password_baru').prop('required', true);
                        } else {
                            $('.div_password').prop('hidden', true);
                            $('#password_baru').prop('disabled', true);
                            $('#password_baru').prop('required', false);
                        }
                    });
                }
            })
        });

        $("#form_edit_user").submit(function(e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            // console.log(form_data)
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>manajemen/user/updateData",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let icon = ``;
                    let title = ``;
                    let text = ``;
                    if (response.code === 200) {
                        icon = `success`;
                        title = `Success`;
                    } else {
                        icon = `error`;
                        title = `Error`;
                    }
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: response.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(isConfirm) {
                        location.reload()
                    });
                }
            });
        });

    });
</script>
<!-- end Topbar -->