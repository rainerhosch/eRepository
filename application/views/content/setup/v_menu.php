<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                            </div>
                        </div> -->

                        <div class="float-end">
                            <button class="btn btn-xs btn-info" id="btnAddMenu">Add Menu</button>
                            <!-- <button class="btn btn-xs btn-info"><i class="mdi mdi-plus"></i></button> -->
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
</div>
<script>
    $(document).ready(function() {
        $('#btnAddMenu').click(function() {
            // $('#modalAddMenu').modal('show');
            alert('Modul Not Active');
        });
        $.ajax({
            url: "<?= base_url('setup/menu/getData'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                // console.log(response);
                let html = ``;
                let no = 1;
                let editable_atribut = ``;
                $.each(response.data, function(i, v) {
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
                    html += `<td class="text-center">
                                <button type="button" class="btn btn-xs btn-info btnEditMenu" data-id="${v.id_menu}" ${editable_atribut}><i class="fas fa-pen"></i></button> | <button type="button" class="btn btn-xs btn-danger btnDeleteMenu" data-id="${v.id_menu}" ${editable_atribut}><i class="fas fa-trash-alt"></i></button>
                                </td>`;
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
                    // console.log(id);
                    // console.log(status_awal);
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
                    alert('Edit menu dengan id ' + id);
                })
                $('.btnDeleteMenu').on('click', function() {
                    let id = $(this).data('id');
                    alert('Delete menu dengan id ' + id);
                })

            }
        });
    });
</script>