<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                            </div>
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
<script>
    $(document).ready(function() {
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
                                <button type="button" class="btn btn-xs btn-info" ${editable_atribut}><i class="fas fa-pen"></i></button> | <button type="button" class="btn btn-xs btn-danger" ${editable_atribut}><i class="fas fa-trash-alt"></i></button>
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
            }
        });
    });
</script>