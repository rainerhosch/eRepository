<style>
    .ui-autocomplete {
        z-index: 2147483647;
    }

    .input-group-text {
        width: 12rem;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row div_alert">
            <?php if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('success') . '</div>';
                unset($_SESSION['success']);
            } elseif ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
                unset($_SESSION['error']);
            }
            ?>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data Master Denda</h4>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <button class="btn float-end btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btn_inputDenda"><i class="mdi mdi-plus me-1"></i>Tambah Data Denda</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-2 col-sm-2 col-xs-12">
                                <div class="dataTables_length"></div>
                                <select id="datatable_length" name="datatable_length" aria-controls="datatable" class="form-select form-select-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-xl-10 col-sm-10 col-xs-12">
                                <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="Cari..." aria-controls="datatable"></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Denda</th>
                                        <th>Biaya Denda</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Tools</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody_denda" id="tbody_denda">
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5 hidden-xs">
                                <div class="dataTables_info" id="datatable_info_peminjaman" role="status" aria-live="polite"></div>
                            </div>
                            <!-- Paginate -->
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="pagination_denda">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Denda -->
    <div class="modal fade" id="modalAddDenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Denda Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_masterdata_denda" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="input_nama_denda" class="col-sm-3 col-form-label">Nama Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nama_denda" name="input_nama_denda" placeholder="masukan nama denda" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_jml_denda" class="col-sm-3 col-form-label">Biaya Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_jml_denda" name="input_jml_denda" placeholder="jumlah denda..." required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_desc_denda" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_desc_denda" name="input_desc_denda" placeholder="Deskripsi/keterangan denda" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-sm btn-primary btnSaveMasterDenda" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Denda -->
    <div class="modal fade" id="modalEditDenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Denda Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_masterdata_denda" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="edit_nama_denda" class="col-sm-3 col-form-label">Nama Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edit_nama_denda" name="edit_nama_denda" placeholder="masukan nama denda" required>
                                <input type="hidden" class="form-control" id="edit_id_denda" name="edit_id_denda">
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="edit_jml_denda" class="col-sm-3 col-form-label">Biaya Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edit_jml_denda" name="edit_jml_denda" placeholder="jumlah denda..." required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="edit_desc_denda" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edit_desc_denda" name="edit_desc_denda" placeholder="Deskripsi/keterangan denda" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-sm btn-primary btnSaveUpdateMasterDenda" style="float: right;">Submit</button>
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
        $('.btn-close').on('click', function() {
            location.reload();
        });

        function getDateNow() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            return today;
        }
        $('#btn_inputDenda').on('click', function() {
            $('#modalAddDenda').modal('show');
        });
        $('.btnSaveMasterDenda').on('click', function() {
            var form = $("form#form_add_masterdata_denda").serialize();
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>manajemen/denda/insertMasterDataDenda',
                data: form,
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    let alert = res.alert;
                    Swal.fire({
                        icon: alert.icon,
                        title: alert.title,
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });

        setTimeout(function() {
            $(".div_alert").fadeOut('slow');
        }, 2000);
        var limit = $('select[name="datatable_length"]').val();

        setTimeout(function() {
            $(".div_alert").fadeOut('slow');
        }, 2000);

        $('select[name="datatable_length"]').on('change', function() {
            let limit = $(this).val();
            // console.log(limit);
            loadPagination(limit);
        });
        loadPagination(limit);

        $(".datatable_filter").keyup(function(e) {
            e.preventDefault();
            let keyword = $(this).val();
            // console.log(keyword)
            loadFilter(keyword);
        });

        $('#pagination_denda').on('click', 'a', function(e) {
            e.preventDefault();
            let limit = $('#datatable_length').val();
            let offset = $(this).attr('data-ci-pagination-page');
            loadPagination(limit, offset);
        });

        // Load filter
        function loadFilter(keyword) {
            $.ajax({
                url: '<?= base_url(); ?>manajemen/denda/getDataForPagination',
                type: 'POST',
                data: {
                    keyword: keyword,
                    limit: limit,
                    url_pagination: 'DataMasterDenda'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    let limit = response.data.limit_per_page;
                    let data_denda = response.data.data_denda;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;

                    // console.log(total_data);
                    $('#pagination_denda').html(response.pagination);
                    createTable(data_denda, total_data, limit, offset);
                }
            });
        }

        // Load pagination
        function loadPagination(limit, offset) {
            offset = typeof offset !== 'undefined' ? offset : 0;
            let page = offset * limit;
            $.ajax({
                url: '<?= base_url(); ?>manajemen/denda/getDataForPagination/' + offset,
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    // page: page,
                    url_pagination: 'DataMasterDenda'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_denda = response.data.data_denda;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_denda').html(response.data.pagination_link);
                    $('ul.pagination li a').addClass('page-link');
                    createTable(data_denda, total_data, limit, offset);
                }
            });
        }

        function createTable(data_denda, total_data, limit, offset) {
            // console.log(data_denda);
            let html = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();

            if (data_denda != 0) {
                let numEnd = Number(limit) + Number(offset);
                if (parseInt(total_data) < parseInt(numEnd)) {
                    $('#datatable_info_peminjaman').html(`<strong>${offset+1}</strong>-<strong>${total_data}</strong> dari <strong>${total_data}</strong> Data`);
                } else {
                    $('#datatable_info_peminjaman').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Data`);
                }
                let no = 1;
                $.each(data_denda, function(k, item) {
                    html += `<tr>`;
                    html += `<td><small>${no}</small></td>`;
                    html += `<td><small>${item.nama_denda}</small></td>`;
                    html += `<td><small>${item.jml_denda}</small></td>`;
                    html += `<td><small>${item.desc_denda}</small></td>`;
                    html += `<td class="text-center">`;
                    html += `<button class="btn btn-xs btn-warning btn_edit_m_denda" data-id="${item.id_denda}" data-nama="${item.nama_denda}" data-jml="${item.jml_denda}" data-desc="${item.desc_denda}"><i class="mdi mdi-pencil-outline"></i></button> | <button class="btn btn-xs btn-danger btn_delete_m_denda" data-id="${item.id_denda}"><i class="mdi mdi-delete"></i></button></td>`;
                    html += `</tr>`;
                    no++;
                });
            } else {
                html += `<tr>`;
                html += `<td colspan="7" class="text-center"><i>Tidak ada data</i></td>`;
                html += `</tr>`;
            }
            $('.tbody_denda').html(html);
            $('.btn_edit_m_denda').on('click', function() {
                let id_denda = $(this).data('id');
                let nama_denda = $(this).data('nama');
                let jml_denda = $(this).data('jml');
                let desc_denda = $(this).data('desc');
                $('#edit_id_denda').val(id_denda);
                $('#edit_nama_denda').val(nama_denda);
                $('#edit_jml_denda').val(jml_denda);
                $('#edit_desc_denda').val(desc_denda);
                $('#modalEditDenda').modal('show');
            });
            $('.btn_delete_m_denda').on('click', function() {
                let id_denda = $(this).data('id');
                // console.log(id_denda)
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url(); ?>manajemen/denda/deleteMasterDataDenda',
                    data: {
                        id_denda: id_denda
                    },
                    dataType: 'json',
                    success: function(res) {
                        // console.log(res)
                        let alert = res.alert;
                        Swal.fire({
                            icon: alert.icon,
                            title: alert.title,
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            });
        }
        $('.btnSaveUpdateMasterDenda').on('click', function() {
            var form = $("form#form_edit_masterdata_denda").serialize();
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>manajemen/denda/updateMasterDataDenda',
                data: form,
                dataType: 'json',
                success: function(res) {
                    // console.log(res)
                    let alert = res.alert;
                    Swal.fire({
                        icon: alert.icon,
                        title: alert.title,
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });




    });
</script>