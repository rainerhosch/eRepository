<script src="<?= base_url('assets/template'); ?>/libs/jquery/jquery-migrate.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/libs/jquery-ui/jquery.ui.autocomplete.scroll.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/js/autocomplete.js"></script>
<style>
    .ui-autocomplete {
        z-index: 2147483647;
    }

    .modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
    }

    .hiddenRow {
        padding: 0 !important;
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
                                <h4 class="header-title mt-0 mb-3">Data Dalam Pengambalian</h4>
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
                                <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="NISN, Judul, Nama" aria-controls="datatable"></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buku Dipinjam</th>
                                        <th>Tanggal Pengambalian</th>
                                        <th>Peminjam</th>
                                        <th>Petugas</th>
                                        <th>Total Denda</th>
                                        <th class="text-center">Tools</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody_pengembalian_buku" id="tbody_pengembalian_buku">
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5 hidden-xs">
                                <div class="dataTables_info" id="datatable_info_pengembalian" role="status" aria-live="polite"></div>
                            </div>
                            <!-- Paginate -->
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="pagination_pengembalian">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Pengambalian -->
    <div class="modal fade" id="modalAddPengambalian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Pengambalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_buku" enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>transaksi/pengembalian/insertPengambalian">
                        <div class="form-group row">
                            <label for="input_nisn" class="col-sm-3 col-form-label">ID ANGGOTA</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nisn" name="input_nisn" placeholder="search by nisn anggota" required>
                                <input type="hidden" class="form-control" id="input_iduser" name="input_iduser">
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nama" name="input_nama" placeholder="Nama Anggota" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-1">
                            <label for="input_judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <textarea name="input_judul_buku" id="input_judul_buku" class="form-control" rows="3" required="required" placeholder="Cari judul buku yang akan di pinjam..."></textarea>
                                <input type="hidden" class="form-control" id="input_idbuku" name="input_idbuku">
                                <!-- <div id="div_input_idbuku"></div> -->
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_tgl_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengambalian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_tgl_pengembalian" name="input_tgl_pengembalian" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary btn_save_buku" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pengembalian Buku -->

</div>
<script>
    $(document).ready(function() {
        function getDateNow() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            return today;
        }

        setTimeout(function() {
            $(".div_alert").fadeOut('slow');
        }, 2000);
        var limit = $('select[name="datatable_length"]').val();

        setTimeout(function() {
            $(".div_alert").fadeOut('slow');
        }, 2000);

        $('input[name="input_tgl_pengembalian"]').daterangepicker({
            // locale: {
            //     format: 'Y/M/D'
            // },
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('Y-M-D') + ' to ' + end.format('Y-M-D'));
        });


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

        $('#pagination_pengembalian').on('click', 'a', function(e) {
            e.preventDefault();
            let limit = $('#datatable_length').val();
            let offset = $(this).attr('data-ci-pagination-page');
            loadPagination(limit, offset);
        });

        // Load filter
        function loadFilter(keyword) {
            $.ajax({
                url: '<?= base_url(); ?>transaksi/pengembalian/getData',
                type: 'POST',
                data: {
                    keyword: keyword,
                    limit: limit,
                    url_pagination: 'DataPengambalianBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {

                    console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_pengembalian = response.data.pengembalian;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_pengembalian').html(response.pagination);
                    createTable(data_pengembalian, total_data, limit, offset);
                }
            });
        }

        // Load pagination
        function loadPagination(limit, offset) {
            offset = typeof offset !== 'undefined' ? offset : 0;
            let page = offset * limit;
            $.ajax({
                url: '<?= base_url(); ?>transaksi/pengembalian/getData/' + offset,
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    // page: page,
                    url_pagination: 'DataPengambalianBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_pengembalian = response.data.pengembalian;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_pengembalian').html(response.data.pagination_link);
                    $('ul.pagination li a').addClass('page-link');
                    createTable(data_pengembalian, total_data, limit, offset);
                }
            });
        }

        function createTable(data_pengembalian, total_data, limit, offset) {
            console.log(data_pengembalian);
            let html = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();

            if (data_pengembalian != 0) {
                let numEnd = Number(limit) + Number(offset);
                // console.log(numEnd);
                if (total_data < numEnd) {
                    $('#datatable_info_pengembalian').html(`<strong>${offset+1}</strong>-<strong>${total_data}</strong> dari <strong>${total_data}</strong> Data`);
                } else {
                    $('#datatable_info_pengembalian').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Data`);
                }
                let no = 1;
                $.each(data_pengembalian, function(k, item) {
                    html += `<tr>`;
                    html += `<td><small>${no}</small></td>`;
                    html += `<td>`;
                    $.each(item.buku_dipinjam, function(j, item_buku) {
                        html += `<i style="font-size:11px; font-weight: bold;">- ${item_buku.judul_buku}</i><br>`;
                    });
                    html += `</td>`;
                    html += `<td><small>${item.tanggal_pengembalian}</small></td>`;
                    html += `<td><small>${item.nama_anggota}</small></td>`;
                    html += `<td><small>${item.nama_petugas}</small></td>`;
                    let total_denda = 0;
                    $.each(item.data_denda, function(j, val) {
                        total_denda = total_denda + Number(val.jml_denda);
                    });
                    html += `<td><small>Rp.${parseInt(total_denda).toLocaleString()}</small></td>`;
                    html += `<td><button data-toggle="collapse" data-target="#demo${item.id_pengembalian}" class="btn btn-dark rounded-pill waves-effect waves-dark btn-xs btnShowDetail"><i class="mdi mdi-chevron-double-down"></i></button> </td>`;
                    html += `</tr>`;

                    html += `<tr>`;
                    html += `<td colspan="12" class="hiddenRow">`;
                    html += `<div id="demo${item.id_pengembalian}" class="accordian-body collapse detailMenuAccess">`;
                    html += `<table class="table table-striped table-bordered table-sm">`;
                    html += `<thead>`;
                    html += `<tr>`;
                    html += `<th class="text-center">Jenis Denda</th>`;
                    html += `<th class="text-center">Nama Buku</th>`;
                    html += `<th class="text-center">Jumlah Denda</th>`;
                    html += `</tr>`;
                    html += `</thead>`;
                    $.each(item.data_denda, function(i, denda) {
                        html += `<tbody>`;
                        html += `<tr>`;
                        html += `<td class="text-center">${denda.desc_denda}</td>`;
                        html += `<td class="text-center">${denda.judul_buku}</td>`;
                        html += `<td class="text-center">${denda.jml_denda}</td>`;
                        html += `</tr>`;
                        html += `</tbody>`;
                    });
                    html += `</table>`;
                    html += `</div>`;
                    html += `</td>`;
                    html += `</tr>`;
                    no++;
                });
            } else {
                html += `<tr>`;
                html += `<td colspan="7" class="text-center"><i>Tidak ada data</i></td>`;
                html += `</tr>`;
            }
            $('.tbody_pengembalian_buku').html(html);
            $('.btnShowDetail').on('click', function() {
                let id = $(this).attr('data-target');
                $('.detailMenuAccess').removeClass('show');
                $(id).collapse('toggle');
            });
            $('.btnToolsPeminjaan').click(function() {
                let id = $(this).data('id');
                let denda = $(this).data('denda');
                let id_buku = $(this).data('idbuku');
                let id_anggota = $(this).data('peminjam');
                let tgl_pengembalian = getDateNow();
                // console.log(id);
                // console.log(denda);
                // console.log(id_buku);
                console.log(id_anggota);
            });
        }

        $('#btn_inputPengambalian').click(function() {
            $('#modalAddPengambalian').modal('show');
        });

        // Auto complete user
        $('#input_nisn').autocomplete({
            maxShowItems: 5,
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: '<?= base_url(); ?>manajemen/user/getDataForAutoComplete',
                    type: 'post',
                    dataType: "json",
                    serverSide: true,
                    data: {
                        filter: '4',
                        search: request.term
                    },
                    success: function(res) {
                        response(res.data_autocomplete);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#input_nisn').val(ui.item.value); // display the selected text
                $('#input_iduser').val(ui.item.id); // save selected id to input
                $('#input_nama').val(ui.item.label); // save selected id to input
                return false;
            },
            focus: function(event, ui) {
                $("#input_nisn").val(ui.item.value);
                $('#input_iduser').val(ui.item.id);
                $("#input_nama").val(ui.item.label);
                return false;
            },
        });

        // multyple autocomplete
        $("#input_judul_buku").autocomplete({
            source: function(request, response) {
                var searchText = extractLast(request.term);
                $.ajax({
                    url: '<?= base_url(); ?>manajemen/buku/getDataForAutoComplete',
                    type: 'post',
                    dataType: "json",
                    serverSide: true,
                    data: {
                        search: searchText
                    },
                    success: function(res) {
                        // console.log(res);
                        response(res.data);
                    }
                });
            },
            select: function(event, ui) {
                var terms = split($('#input_judul_buku').val());

                terms.pop();

                terms.push(ui.item.value);

                terms.push("");
                $('#input_judul_buku').val(terms.join("\n"));

                // Id buku
                terms = split($('#input_idbuku').val());
                terms.pop();
                terms.push(ui.item.id);
                terms.push("");
                $('#input_idbuku').val(terms.join("\n"));

                return false;
            }

        });

    });

    function split(val) {
        return val.split(/\n\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>