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
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3 text-end">Pengunjung</h4>
                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end row">
                                <h2 class="fw-normal mb-1" id="jml_kunjungan_mounth"></h2>
                                <p class="text-muted mb-1 today_date"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3 text-end">Data Pengembalian</h4>
                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end row">
                                <h2 class="fw-normal mb-1" id="jml_pengembalian_mounth"></h2>
                                <p class="text-muted mb-1 today_date"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3 text-end">Data Peminjaman</h4>
                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end row">
                                <h2 class="fw-normal mb-1" id="jml_peminjaman_mounth"></h2>
                                <p class="text-muted mb-1 today_date"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3 text-end">Kas Denda</h4>
                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end row">
                                <h2 class="fw-normal mb-1 float-start" id="jml_denda_mounth"></h2>
                                <p class="text-muted mb-1 this_mounth"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <form action="#" id="form_insert_pengunjung">
                            <input type="text" class="form-control form-control-sm insert_nisn" name="insert_nisn" placeholder="insert nisn pengunjung">
                            <small id="insertNisnHelp" class="form-text text-muted" hidden></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data Pengunjung</h4>
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
                                <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="NISN, Nama" aria-controls="datatable"></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>NISN</th>
                                        <th>NAMA</th>
                                        <!-- <th>Alamat</th> -->
                                        <!-- <th>Tlpn</th> -->
                                        <!-- <th class="text-center">Tools</th> -->
                                    </tr>
                                </thead>
                                <tbody class="tbody_kunjungan" id="tbody_kunjungan">
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5 hidden-xs">
                                <div class="dataTables_info" id="datatable_info_kunjungan" role="status" aria-live="polite"></div>
                            </div>
                            <!-- Paginate -->
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="pagination_kunjungan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Peminjaman -->
    <div class="modal fade" id="modalAddPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_buku" enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manajemen/kunjungan/insertPeminjaman">
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
                            <label for="input_tgl_kunjungan" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_tgl_kunjungan" name="input_tgl_kunjungan" required>
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
        $('.insert_nisn').on('input', function() {
            let nisn = $(this).val();
            let msg = '';
            $.ajax({
                url: '<?= base_url(); ?>kunjungan/insertData',
                type: 'POST',
                data: {
                    nisn: nisn
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    msg += response.message;
                    console.log(response)
                    if (response.code === 200) {
                        Swal.fire({
                            icon: "success",
                            title: msg,
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        $('#insertNisnHelp').html(`<i><code>${msg}</i>`);
                        $('#insertNisnHelp').prop('hidden', false);
                        setTimeout(function() {
                            $('#insertNisnHelp').prop('hidden', true);
                        }, 1500);
                    }
                }
            });
        });
        $.ajax({
            url: '<?= base_url(); ?>transaksi/pengembalian/getData',
            type: 'POST',
            data: {
                filter_mounth: 'date'
            },
            serverSide: true,
            dataType: 'json',
            success: function(response) {
                // console.log(response)
                let data_pengembalian = response.data.pengembalian;
                let total_denda = 0;
                $.each(data_pengembalian, function(k, item) {
                    if (item.data_denda.length != 0) {
                        $.each(item.data_denda, function(k, val) {
                            total_denda += parseInt(val.jml_denda);
                        });
                    }
                });
                $('#jml_pengembalian_mounth').append(data_pengembalian.length);
                $('#jml_denda_mounth').append(`<i>Rp.${parseInt(total_denda).toLocaleString()}</i>`);
            }
        });
        $.ajax({
            url: '<?= base_url(); ?>transaksi/peminjaman/getData',
            type: 'POST',
            data: {
                filter_mounth: 'date'
            },
            serverSide: true,
            dataType: 'json',
            success: function(response) {
                let jml_peminjaman = response.data.peminjaman.length;
                $('#jml_peminjaman_mounth').append(jml_peminjaman);
            }
        });

        $.ajax({
            url: '<?= base_url(); ?>kunjungan/getDataPerBulan',
            type: 'POST',
            serverSide: true,
            data: {
                filter_mounth: true
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response)
                let jml_kunjungan_bulan_ini = response.data.kunjungan_bulan_ini;
                let bulan = response.data.bulan_ini;
                let date_now = response.data.tgl_bulan_ini;
                $('#jml_kunjungan_mounth').append(jml_kunjungan_bulan_ini);
                $('.this_mounth').append('Bulan ' + bulan);
                $('.today_date').append(date_now);
            }
        });



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

        $('input[name="input_tgl_kunjungan"]').daterangepicker({
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

        $('#pagination_kunjungan').on('click', 'a', function(e) {
            e.preventDefault();
            let limit = $('#datatable_length').val();
            let offset = $(this).attr('data-ci-pagination-page');
            loadPagination(limit, offset);
        });

        // Load filter
        function loadFilter(keyword) {
            $.ajax({
                url: '<?= base_url(); ?>kunjungan/getData',
                type: 'POST',
                data: {
                    keyword: keyword,
                    limit: limit,
                    url_pagination: 'DataKunjungan'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {

                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_kunjungan = response.data.kunjungan;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_kunjungan').html(response.pagination);
                    createTable(data_kunjungan, total_data, limit, offset);
                }
            });
        }

        // Load pagination
        function loadPagination(limit, offset) {
            offset = typeof offset !== 'undefined' ? offset : 0;
            let page = offset * limit;
            $.ajax({
                url: '<?= base_url(); ?>kunjungan/getData/' + offset,
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    // page: page,
                    url_pagination: 'DataKunjungan'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_kunjungan = response.data.kunjungan;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_kunjungan').html(response.data.pagination_link);
                    $('ul.pagination li a').addClass('page-link');
                    createTable(data_kunjungan, total_data, limit, offset);
                }
            });
        }

        function createTable(data_kunjungan, total_data, limit, offset) {
            // console.log(limit);
            // console.log(data_kunjungan);
            let html = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();

            if (data_kunjungan != 0) {
                let no = 1;
                let numEnd = Number(limit) + Number(offset);
                $('#datatable_info_kunjungan').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Record`);
                $.each(data_kunjungan, function(k, item) {
                    html += `<tr>`;
                    html += `<td><small>${no}</small></td>`;
                    html += `<td>${item.tgl_kunjungan}</td>`;
                    html += `<td>${item.time_kunjungan}</td>`;
                    html += `<td>${item.nisn}</td>`;
                    html += `<td>${item.nama}</td>`;
                    html += `</tr>`;
                    no++;
                });
            } else {
                html += `<tr>`;
                html += `<td colspan="7" class="text-center"><i>Tidak ada data</i></td>`;
                html += `</tr>`;
            }
            $('.tbody_kunjungan').html(html);
        }

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

    });

    function split(val) {
        return val.split(/\n\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>