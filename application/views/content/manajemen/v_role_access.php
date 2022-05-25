<style>
    .hiddenRow {
        padding: 0 !important;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <button class="btn btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddRole"><i class="mdi mdi-plus me-1"></i>Add <?= $subpage; ?></button>
                        </div>
                        <h4 class="header-title mt-0 mb-3">Data <?= $subpage; ?></h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ROLE</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">MENU ACCESS</th>
                                        <th class="text-center">TOOLS</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_role_access">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal add role_access -->
    <div class="modal fade" id="modalAddRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_user_role" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="role_type" class="col-sm-3 col-form-label">Type Role</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="role_type" name="role_type" placeholder="Nama / Type Role" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desc" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" required>
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

    <!-- modal edit role_access -->
    <div class="modal fade" id="modalEditMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit <?= $subpage; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" id="formEditMenu">
                        <div class="position-relative mb-3">
                            <label for="editNamaMenu" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNamaMenu" name="editNamaMenu" placeholder="Nama role_access..." required="">
                            <input type="hidden" class="form-control" id="editIdMenu" name="editIdMenu">
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="editUrlMenu" class="form-label">Url</label>
                            <input type="text" class="form-control" id="editUrlMenu" name="editUrlMenu" placeholder="link url role_access..." required="">
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="editIconMenu" class="form-label">Icon</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="editIconMenu" name="editIconMenu" placeholder="Icon untuk role_access" aria-describedby="inputIconMenuPrepend" required="">
                                <div class="invalid-tooltip">
                                    Tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Tipe</label>

                            <div class="form-check mb-1">
                                <input type="radio" name="editTipeMenu" id="editTipeMenu2" value="2" required=" " class="form-check-input" data-parsley-multiple="TipeMenu">
                                <label for="editTipeMenu2" class="form-check-label">Dinamis <code><i>(mempunyai subrole_access)</i></code></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="editTipeMenu" id="editTipeMenu1" value="1" class="form-check-input" data-parsley-multiple="TipeMenu">
                                <label for="editTipeMenu2" class="form-check-label">Statis</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btnSaveMenuEdit" type="button">Submit form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add menu access -->
    <div class="modal fade" id="modalAddMenuAccess" tabindex="-1" role="dialog" aria-labelledby="modalAddMenuAccessTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Akses Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_menu_access" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="type_role" class="col-sm-3 col-form-label">Type Role</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="id_role" name="id_role" readonly>
                                <input type="text" class="form-control" id="type_role" name="type_role" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select_menu_access" class="col-sm-3 col-form-label">Menu</label>
                            <div class="col-sm-9">
                                <select class="form-select custom-select" id="select_menu_access" name="select_menu_access">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary btn_save_menu_access" style="float: right;" disabled>Submit</button>
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
        $.ajax({
            url: "<?= base_url(); ?>manajemen/roleuser/getData",
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                let html = ``;
                let no = 1;
                console.log(response);
                $.each(response.data, function(i, v) {
                    let disabled = ``;
                    html += `<tr>`
                    html += `<td class="text-center">${no}</td>`
                    html += `<td class="text-center">${v.role_type}</td>`
                    html += `<td class="text-center">${v.description}</td>`
                    if (v.editable === '0') {
                        disabled = 'disabled';
                    }
                    html += `<td class="text-center">`;
                    html += `<button data-toggle="collapse" data-target="#demo${v.role_id}" class="btn btn-dark rounded-pill waves-effect waves-dark btn-xs btnShowDetail" ${disabled} ><i class="mdi mdi-chevron-double-down"></i></button> `;
                    html += `<button class="btn btn-primary rounded-pill waves-effect waves-light btn-xs btn_add_menu_access" nama-role="${v.role_type}" value="${v.role_id}" ${disabled}><i class="mdi mdi-plus"></i></button>`;
                    html += `</td>`
                    html += `<td class="text-center"><button class="btn btn-danger rounded-pill waves-effect waves-light btn-xs btn_delete_role" role-type="${v.role_type}" value="${v.role_id}" ${disabled}><i class="fas fa-trash-alt"></i></button></td>`;
                    html += `</tr>`;
                    html += `<tr>`;
                    html += `<td colspan="12" class="hiddenRow">`;
                    html += `<div id="demo${v.role_id}" class="accordian-body collapse detailMenuAccess">`;
                    html += `<table class="table table-striped table-bordered table-sm">`;
                    html += `<thead>`;
                    html += `<tr>`;
                    html += `<th class="text-center">Nama Menu</th>`;
                    html += `<th class="text-center">Tools</th>`;
                    html += `</tr>`;
                    html += `</thead>`;
                    $.each(v.role_access_menu, function(i, ram) {
                        html += `<tbody>`;
                        html += `<tr>`;
                        html += `<td class="text-center">${ram.nama_menu}</td>`;
                        html += `<td class="text-center">`;
                        if (ram.editable != 'N/A') {
                            html += `<a class="btn btn-xs btn-danger btn_delete_uam" nama-menu-access="${ram.nama_menu}" data-id_role="${v.role_id}" data-id_menu="${ram.id_menu}"><i class="fas fa-trash-alt"></i></a>`;
                        } else {
                            html += `<i>Not Deletable!</i>`;
                        }
                        html += `</td>`;
                        html += `</tr>`;
                        html += `</tbody>`;
                    });
                    html += `</table>`;
                    html += `</div>`;
                    html += `</td>`;
                    html += `</tr>`;
                    no++;
                });
                $('tbody#tbody_role_access').html(html);
                $('#btnAddRole').on('click', function() {
                    $('#modalAddRole').modal('show');
                });

                $('.btn_add_menu_access').on('click', function() {
                    let role_id = $(this).attr('value');
                    $('#modalAddMenuAccess').modal("show");
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>manajemen/roleuser/getData",
                        data: {
                            role_id: role_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $('#modalAddMenuAccess').modal("show");
                            $("#type_role").val(response.data.role_type);
                            $("#id_role").val(response.data.role_id);
                            if (response.data.menu_can_use != null) {
                                $('#select_menu_access').append(`<option value="x">-- Pilih Menu --</option>`);
                                $.each(response.data.menu_can_use, function(i, menu) {
                                    $('#select_menu_access').append(`<option value="${menu.id_menu}">${menu.nama_menu}</option>`);
                                });
                            }


                        }
                    })
                });
                $('#modalAddMenuAccess').on('hidden.bs.modal', function(e) {
                    $('#form_menu_access')[0].reset();
                    $('#select_menu_access').html(``);
                });
                $('#select_menu_access').on('change', function() {
                    let id_menu = this.value;
                    if (id_menu != 'x') {
                        $('.btn_save_menu_access').prop('disabled', false)
                    } else {
                        $('.btn_save_menu_access').prop('disabled', true)
                    }
                });

                $("#form_user_role").submit(function(e) {
                    e.preventDefault();
                    let form = $(this);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>manajemen/roleuser/simpan_role_baru",
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
                    })
                });

                $("#form_menu_access").submit(function(e) {
                    e.preventDefault();
                    let form = $(this);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>manajemen/roleuser/simpan_menu_access",
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
                    })
                });


                $('.btn_delete_role').on('click', function() {
                    let id = $(this).attr('value');
                    let nama = $(this).attr('role-type');
                    // console.log(nama);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `${nama} role, will delete!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>manajemen/roleuser/deleteData", // where you wanna post
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function(response) {
                                    // console.log(response)
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
                })

                $('.btn_delete_uam').on('click', function() {
                    let id_menu = $(this).data('id_menu');
                    let id_role = $(this).data('id_role');
                    let nama = $(this).attr('nama-menu-access');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `The access to ${nama}, will delete for this role!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>manajemen/roleuser/delete_menu_access", // where you wanna post
                                data: {
                                    id_menu: id_menu,
                                    id_role: id_role,
                                },
                                dataType: "json",
                                success: function(response) {
                                    // console.log(response)
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





                $('.btnShowDetail').on('click', function() {
                    let id = $(this).attr('data-target');
                    $('.detailMenuAccess').removeClass('show');
                    $(id).collapse('toggle');
                });

            }
        });
    });
</script>