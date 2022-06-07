<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <button class="btn btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddUser"><i class="mdi mdi-plus me-1"></i>Add <?= $subpage; ?></button>
                        </div>
                        <h4 class="header-title mt-0 mb-3">Data <?= $subpage; ?></h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA</th>
                                        <th class="text-center">TLP</th>
                                        <th class="text-center">ALAMAT</th>
                                        <th class="text-center">ROLE</th>
                                        <th class="text-center">TOOLS</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_data_user">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add user -->
    <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $subpage; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_user" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="alamat_user" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="email_user" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="tlp_user" class="col-sm-2 col-form-label">No Tlp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tlp_user" name="tlp_user" placeholder="No Tlp/Handphone" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-1">
                            <label for="role_user" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select id="role_user" name="role_user" class="form-select parsley-success" required="" data-parsley-id="21">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="default123" readonly>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary btn_save_role_user" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        var roleUserLogin = '<?= $this->session->userdata('role'); ?>';
        var idUserLogin = '<?= $this->session->userdata('user_id'); ?>';
        $.ajax({
            url: "<?= base_url(); ?>manajemen/user/getData",
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                // console.log(response);
                let html = ``;
                let no = 1;
                $.each(response.data, function(i, v) {
                    let disabled = ``;
                    if (v.role_id == '1' || (roleUserLogin == v.role_id && v.user_id != idUserLogin)) {
                        disabled = `disabled`;
                    }
                    // if (v.role_id > roleUserLogin) {
                    if (roleUserLogin < v.role_id) {
                        html += `<tr>`;
                        html += `<td>${no}</td>`;
                        html += `<td>${v.nama}</td>`;
                        html += `<td class="text-center">${v.tlp}</td>`;
                        html += `<td class="text-center">${v.alamat}</td>`;
                        html += `<td class="text-center">${v.role_type}</td>`;

                        html += `<td class="text-center">`;
                        html += `<button type="button" class="btn btn-xs btn-info btnEditUser" data-user_id="${v.user_id}" data-user_detail_id="${v.user_detail_id}" ${disabled}><i class="fas fa-pen"></i></button>`;
                        html += ` | `;
                        html += `<button type="button" class="btn btn-xs btn-danger btnDeleteUser" data-user_id="${v.user_id}" data-user_detail_id="${v.user_detail_id}" data-nama="${v.nama}" ${disabled}><i class="fas fa-trash-alt"></i></button>`;
                        html += `</td>`;
                        html += `</tr>`;
                        no++;

                    }
                });
                $('#tbody_data_user').html(html);

                $('.btnEditUser').on('click', function() {
                    let id = $(this).data('user_id');
                    console.log(id);
                });

                $('.btnDeleteUser').on('click', function() {
                    let user_id = $(this).data('user_id');
                    let user_detail_id = $(this).data('user_detail_id');
                    // console.log(id);
                    let nama_user = $(this).data("nama");
                    let table = `user`;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `The ${nama_user} user, will delete!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>manajemen/user/hapus_user", // where you wanna post
                                data: {
                                    user_id: user_id,
                                    user_detail_id: user_detail_id,
                                    table: table
                                },
                                dataType: "json",
                                success: function(response) {
                                    let title = ``;
                                    let msg = ``;
                                    let icon = ``;
                                    if (response.code === 200) {
                                        title = `Deleted`;
                                        icon = `success`;
                                    } else {
                                        title = `Error!`;
                                        icon = `error`;
                                    }
                                    Swal.fire(
                                        title,
                                        response.msg,
                                        icon
                                    )
                                    location.reload();
                                }
                            })
                        }
                    })
                });

            }
        });

        $('#btnAddUser').on('click', function() {

            $.ajax({
                url: "<?= base_url(); ?>setup/roleuser/getData",
                type: "POST",
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    let html = ``;
                    html += `<option value="" hidden>Pilih Role...</option>`;
                    $.each(response.data, function(i, v) {
                        if (v.role_id > roleUserLogin) {
                            html += `<option value="${v.role_id}">${v.role_type}</option>`;
                        }
                    });
                    $('#role_user').html(html);
                }
            });
            $('#modalAddUser').modal('show');
        });

        $("#form_add_user").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/auth/process_registration",
                data: form.serializeArray(),
                dataType: "json",
                success: function(response) {
                    // console.log(response);
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