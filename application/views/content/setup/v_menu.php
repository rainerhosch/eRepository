<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <button class="btn btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddMenu"><i class="mdi mdi-plus me-1"></i>Add Menu</button>
                        </div>
                        <h4 class="header-title mt-0 mb-3">Data <?= $subpage; ?></h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA</th>
                                        <th class="text-center">URL SEGMEN</th>
                                        <th class="text-center">TIPE</th>
                                        <th class="text-center">ICON</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">TOOL</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_menu">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal add menu -->
    <div class="modal fade" id="modalAddMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah <?= $subpage; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" id="formAddMenu">
                        <div class="position-relative mb-3">
                            <label for="inputNamaMenu" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="inputNamaMenu" name="inputNamaMenu" placeholder="Nama menu..." required="">
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="inputUrlMenu" class="form-label">Url</label>
                            <input type="text" class="form-control" id="inputUrlMenu" name="inputUrlMenu" placeholder="link url menu..." required="">
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="inputIconMenu" class="form-label">Icon</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputIconMenu" name="inputIconMenu" placeholder="Icon untuk menu" aria-describedby="inputIconMenuPrepend" required="">
                                <div class="invalid-tooltip">
                                    Tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Tipe</label>

                            <div class="form-check mb-1">
                                <input type="radio" name="inputTipeMenu" id="tipeMenu2" value="2" required=" " class="form-check-input" data-parsley-multiple="TipeMenu">
                                <label for="tipeMenu2" class="form-check-label">Dinamis <code><i>(mempunyai submenu)</i></code></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="inputTipeMenu" id="tipeMenu1" value="1" class="form-check-input" data-parsley-multiple="TipeMenu">
                                <label for="tipeMenu2" class="form-check-label">Statis</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btnSaveMenu">Submit form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal edit menu -->
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
                            <input type="text" class="form-control" id="editNamaMenu" name="editNamaMenu" placeholder="Nama menu..." required="">
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
                            <input type="text" class="form-control" id="editUrlMenu" name="editUrlMenu" placeholder="link url menu..." required="">
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
                                <input type="text" class="form-control" id="editIconMenu" name="editIconMenu" placeholder="Icon untuk menu" aria-describedby="inputIconMenuPrepend" required="">
                                <div class="invalid-tooltip">
                                    Tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Tipe</label>

                            <div class="form-check mb-1">
                                <input type="radio" name="editTipeMenu" id="editTipeMenu2" value="2" required=" " class="form-check-input" data-parsley-multiple="TipeMenu">
                                <label for="editTipeMenu2" class="form-check-label">Dinamis <code><i>(mempunyai submenu)</i></code></label>
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

</div>

<script>
    $(document).ready(function() {

        $('#btnAddMenu').click(function() {
            $('#modalAddMenu').modal('show');
        });
        // reset form modal
        $('#modalAddMenu').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        });

        $('#formAddMenu').submit(function(e) {
            e.preventDefault();
            var $form = $(this);
            if (!$form.valid) return false;
            $.ajax({
                url: "<?= base_url(); ?>setup/menu/addData",
                type: "POST",
                data: $('#formAddMenu').serialize(),
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    Swal.fire({
                        icon: response.status,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });


        $.ajax({
            url: "<?= base_url('setup/menu/getData'); ?>",
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                // console.log(response);
                let html = ``;
                let no = 1;
                $.each(response.data, function(i, v) {
                    let editable_atribut = ``;
                    if (v.editable == "N/A") {
                        editable_atribut = `disabled`;
                    }
                    html += `<tr>`;
                    html += `<td>${no}</td>
                                <td>${v.nama_menu}</td>
                                <td class="text-center">${v.link_menu}</td>`;
                    if (v.type == '1') {
                        html += `<td class="text-center">STATIS</td>`;
                    } else {
                        html += `<td class="text-center">DINAMIS</td>`;
                    }
                    html += `<td class="text-center">${v.icon}</td>`;
                    html += `<td class="text-center"><label class="form-switch">`;
                    if (v.is_active == '0') {
                        html += `<input type="checkbox" class="form-check-input menuSwitch" data-id="${v.id_menu}" value="${v.is_active}" ${editable_atribut}>`;
                    } else {
                        html += `<input type="checkbox" class="form-check-input menuSwitch" data-id="${v.id_menu}" checked="" value="${v.is_active}" ${editable_atribut}>`;
                    }
                    html += `</label></td>`;
                    html += `<td class="text-center">`;
                    html += `<button type="button" class="btn btn-xs btn-info btnEditMenu" data-id="${v.id_menu}" ${editable_atribut}><i class="fas fa-pen"></i></button>`;
                    html += ` | `;
                    html += `<button type="button" class="btn btn-xs btn-danger btnDeleteMenu" data-id="${v.id_menu}" ${editable_atribut}><i class="fas fa-trash-alt"></i></button>`;
                    html += `</td>`;
                    html += `</tr>`;
                    no++;
                });
                $('#tbody_menu').html(html);
                $('.menuSwitch').change(function() {
                    let id = $(this).data('id');
                    let status_awal = $(this).val();
                    if (status_awal == '0') {
                        status_awal = '1';
                    } else {
                        status_awal = '0';
                    }
                    $.ajax({
                        url: "<?= base_url('setup/menu/updateData'); ?>",
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



                $('.btnEditMenu').on('click', function() {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "<?= base_url('setup/menu/getData'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            // console.log(response);
                            $('#editIdMenu').val(response.data.id_menu);
                            $('#editNamaMenu').val(response.data.nama_menu);
                            $('#editUrlMenu').val(response.data.link_menu);
                            $('#editIconMenu').val(response.data.icon);
                            if (response.data.type == '1') {
                                $('#editTipeMenu1').prop('checked', true);
                            } else {
                                $('#editTipeMenu2').prop('checked', true);
                            }
                            $('#modalEditMenu').modal('show');

                            $('.btnSaveMenuEdit').click(function() {
                                $.ajax({
                                    url: "<?= base_url('setup/menu/updateData'); ?>",
                                    type: "POST",
                                    data: $('#formEditMenu').serialize(),
                                    dataType: "JSON",
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire({
                                            icon: response.status,
                                            title: response.message,
                                            showConfirmButton: false,
                                            timer: 1000
                                        }).then((result) => {
                                            location.reload();
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


                $('.btnDeleteMenu').on('click', function() {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "<?= base_url('setup/menu/deleteData'); ?>",
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