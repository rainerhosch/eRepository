<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <button class="btn btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddSubmenu"><i class="mdi mdi-plus me-1"></i>Add Submenu
                            </button>
                        </div>
                        <h4 class="header-title mt-0 mb-3">Data <?= $subpage; ?></h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PARENT MENU</th>
                                        <th class="text-center">NAMA SUBMENU</th>
                                        <th class="text-center">URL</th>
                                        <th class="text-center">ICON</th>
                                        <th class="text-center">STATUS AKTIF</th>
                                        <th class="text-center">TOOL</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_submenu">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal add submenu -->
<div class="modal fade" id="modalAddSubmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah <?= $subpage; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" id="formAddSubmenu">

                    <div class="position-relative mb-3">
                        <label for="inputMenuParent" class="form-label">Menu</label>
                        <select id="inputMenuParent" name="inputMenuParent" class="form-select parsley-success" required="" data-parsley-id="21">
                        </select>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="inputNamaSubmenu" class="form-label">Nama Submenu</label>
                        <input type="text" class="form-control" id="inputNamaSubmenu" name="inputNamaSubmenu" placeholder="Nama submenu..." required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                        <div class="invalid-tooltip">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="inputUrlSubmenu" class="form-label">Url</label>
                        <input type="text" class="form-control" id="inputUrlSubmenu" name="inputUrlSubmenu" placeholder="link url submenu..." required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                        <div class="invalid-tooltip">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="inputIconSubmenu" class="form-label">Icon</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputIconSubmenu" name="inputIconSubmenu" placeholder="Icon untuk submenu" aria-describedby="inputIconSubmenuPrepend" required="">
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btnSaveSubmenu" type="submit">Submit form</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit submenu -->
<div class="modal fade" id="modalEditSubmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah <?= $subpage; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" id="formEditSubmenu">

                    <div class="position-relative mb-3">
                        <label for="editMenuParent" class="form-label">Menu</label>
                        <select id="editMenuParent" name="editMenuParent" class="form-select parsley-success" required="" data-parsley-id="21">
                        </select>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="editNamaSubmenu" class="form-label">Nama Submenu</label>
                        <input type="text" class="form-control" id="editNamaSubmenu" name="editNamaSubmenu" placeholder="Nama submenu..." required="">
                        <input type="hidden" class="form-control" id="editIdSubmenu" name="editIdSubmenu" required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                        <div class="invalid-tooltip">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="editUrlSubmenu" class="form-label">Url</label>
                        <input type="text" class="form-control" id="editUrlSubmenu" name="editUrlSubmenu" placeholder="link url submenu..." required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                        <div class="invalid-tooltip">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="editIconSubmenu" class="form-label">Icon</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="editIconSubmenu" name="editIconSubmenu" placeholder="Icon untuk submenu" aria-describedby="editIconSubmenuPrepend" required="">
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btnSubmitEdit" type="submit">Submit form</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnAddSubmenu').click(function() {
            $.ajax({
                url: "<?= base_url('setup/menu/getData'); ?>",
                type: "POST",
                dataType: "JSON",
                success: function(response) {
                    let html = ``;
                    html += `<option value="" hidden>Pilih Menu Parent</option>`;
                    $.each(response['data'], function(k, v) {
                        if (v.type === '2') {
                            html += `<option value="${v.id_menu}">${v.nama_menu}</option>`;
                        }
                    });
                    $('#inputMenuParent').html(html);
                    $('#modalAddSubmenu').modal('show');
                }
            });
        });

        // $('#modalAddSubmenu').on('hidden.bs.modal', function() {
        //     $(this).find('form#formAddSubmenu').trigger('reset');
        // });

        $('#formAddSubmenu').submit(function(e) {
            e.preventDefault();
            var $form = $(this);
            // if (!$form.valid) return false;
            // console.log($form)
            $.ajax({
                url: "<?= base_url(); ?>setup/submenu/addData",
                type: "POST",
                data: $('#formAddSubmenu').serialize(),
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    Swal.fire({
                        icon: response.status,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    }).then((result) => {
                        // location.reload();
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });

        $.ajax({
            url: "<?= base_url('setup/submenu/getData'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                // console.log(response);
                let html = ``;
                let no = 1;
                $.each(response.data, function(i, v) {
                    let editable_atribut = ``;
                    if (v.editable != 'YES') {
                        editable_atribut += `disabled`;
                    }
                    html += `<tr>`;
                    html += `<td>${no}</td>
                    <td>${v.menu_parent}</td>
                    <td class="text-center">${v.nama_submenu}</td>`;
                    html += `<td class="text-center">${v.url}</td>`;
                    html += `<td class="text-center">${v.icon}</td>`;
                    html += `<td class="text-center"><label class="form-switch">`;
                    if (v.is_active == '0') {
                        html += `<input type="checkbox" class="form-check-input submenuSwitch" data-id="${v.id_submenu}" value="${v.is_active}" ${editable_atribut}>`;
                    } else {
                        html += `<input type="checkbox" class="form-check-input submenuSwitch" data-id="${v.id_submenu}" checked="" value="${v.is_active}" ${editable_atribut}>`;
                    }
                    html += `</label></td>`;
                    html += `<td class="text-center">
                                <button type="button" class="btn btn-xs btn-info btnEditSubmenu"  data-id="${v.id_submenu}" ${editable_atribut}><i class="fas fa-pen"></i></button> | <button type="button" class="btn btn-xs btn-danger btnDeleteSubmenu"  data-id="${v.id_submenu}" ${editable_atribut}><i class="fas fa-trash-alt"></i></button>
                                </td>`;
                    html += `</tr>`;
                    no++;
                });
                $('#tbody_submenu').html(html);
                $('.submenuSwitch').change(function() {
                    let id = $(this).data('id');
                    let status_awal = $(this).val();
                    if (status_awal == '0') {
                        status_awal = '1';
                    } else {
                        status_awal = '0';
                    }
                    $.ajax({
                        url: "<?= base_url('setup/submenu/updateData'); ?>",
                        type: "POST",
                        data: {
                            id: id,
                            status: status_awal
                        },
                        dataType: "JSON",
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                });

                $('.btnEditSubmenu').on('click', function() {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "<?= base_url('setup/submenu/getData'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log(response);
                            $('#editIdMenu').val(response.data.id_menu);
                            $('#editIdSubmenu').val(response.data.id_submenu);
                            $('#editNamaSubmenu').val(response.data.nama_submenu);
                            $('#editUrlSubmenu').val(response.data.url);
                            $('#editIconSubmenu').val(response.data.icon);
                            
                            $.ajax({
                                url: "<?= base_url('setup/menu/getData'); ?>",
                                type: "POST",
                                dataType: "JSON",
                                success: function(res) {
                                    // console.log(response);
                                    let html = ``;
                                    $.each(res['data'], function(k, v) {
                                        if (v.type === '2') {
                                            let selected =``;
                                            if(v.id_menu == response.data.id_menu){
                                                selected = `selected`;
                                            }
                                            html += `<option value="${v.id_menu}" ${selected}>${v.nama_menu}</option>`;
                                        }
                                    });
                                    $('#editMenuParent').html(html);
                                }
                            })
                            if (response.data.type == '1') {
                                $('#editTipeMenu1').prop('checked', true);
                            } else {
                                $('#editTipeMenu2').prop('checked', true);
                            }
                            $('#modalEditSubmenu').modal('show');

                            $('.btnSubmitEdit').click(function() {
                                $.ajax({
                                    url: "<?= base_url('setup/submenu/updateData'); ?>",
                                    type: "POST",
                                    data: $('#formEditSubmenu').serialize(),
                                    dataType: "JSON",
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire({
                                            icon: response.status,
                                            title: response.message,
                                            showConfirmButton: false,
                                            timer: 1000
                                        }).then((result) => {
                                            // location.reload();
                                        });
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        alert('Error adding / update data');
                                    }
                                });
                            });
                        }
                    });
                });

                $('.btnDeleteSubmenu').on('click', function() {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "<?= base_url('setup/submenu/deleteData'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                })

            }
        });
    });
</script>