<style>
    .profile-image {
        border-radius: 50%;
    }

    .qrcode-image {
        border-radius: 10%;
    }

    .card-qrcode {
        width: 148px;
        height: 148px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-md-2">
                                <img class="qrcode-image" src="<?= base_url('assets/template') ?>/images/users/user-1.jpg" alt="Avatar" style="width:100px">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>NISN</td>
                                            <td> : </td>
                                            <td><?= $user['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>NAMA</td>
                                            <td> : </td>
                                            <td><?= $user['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ALAMAT</td>
                                            <td> : </td>
                                            <td><?= $user['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>NO TLP</td>
                                            <td> : </td>
                                            <td><?= $user['tlp']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="float-end">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><button class="btn btn-sm btn-info btn_qrcode" data-img="<?= $user['qrcode_img'] ?>">Show QR Code</button></td>
                                                <td><button class="btn btn-sm btn-warning btn_edit_profile">EDIT</button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-2"> -->
            <!-- <div class="card">
                    <div class="card-body"> -->
            <!-- <img class="qrcode-image" src="<?= base_url('assets/img/qrcode/') . $this->session->userdata('qrcode_img'); ?>" alt="Avatar" style="width:200px"> -->
            <!-- </div>
                </div> -->
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data Peminjaman</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_peminjaman">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buku Dipinjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Peminjam</th>
                                        <th>Petugas</th>
                                        <th>Denda Hari</th>
                                        <th>Total Denda</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_peminjaman_buku">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data buku -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data buku</h4>
                            </div>
                        </div>
                        <!-- <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="example-datatable" id="keyword_search"> -->
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
                                <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="Cari data" aria-controls="datatable"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="table_buku">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">KATEGORI</th>
                                        <th class="text-center">JUDUL</th>
                                        <th class="text-center">PENULIS</th>
                                        <th class="text-center">PENERBIT</th>
                                        <th class="text-center">TAHUN TERBIT</th>
                                        <th class="text-center">JUMLAH TERSEDIA</th>
                                        <th class="text-center">COVER</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_buku">
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5 hidden-xs">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div>
                            </div>
                            <!-- Paginate -->
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="pagination">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Cover -->
    <div class="modal fade" tabindex="-1" role="dialog" id="image_show">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <img class="modal-content" id="img01">
                    </div>
                    <div class="row text-center">
                        <h5 class="text center judul-buku"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var key = `<?= $this->session->userdata('username') ?>`;

        var limit = $('select[name="datatable_length"]').val();
        $('select[name="datatable_length"]').on('change', function() {
            let limit = $(this).val();
            loadPagination(limit);
        });
        loadPagination(limit);

        $(".datatable_filter").keyup(function(e) {
            e.preventDefault();
            let keyword = $(this).val();
            // console.log(keyword)
            loadFilter(keyword);
        });
        $('#pagination').on('click', 'a', function(e) {
            e.preventDefault();
            let limit = $('#datatable_length').val();
            let offset = $(this).attr('data-ci-pagination-page');
            // console.log(offset)
            // limit = limit || 10;
            loadPagination(limit, offset);
        });

        // Load pagination
        function loadFilter(keyword) {
            let jenis_kas = 'all';
            $.ajax({
                url: '<?= base_url(); ?>manajemen/buku/getData',
                type: 'POST',
                data: {
                    keyword: keyword,
                    limit: limit,
                    url_pagination: 'DataBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_buku = response.data.buku;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination').html(response.pagination);
                    createTable(data_buku, total_data, limit, offset);
                }
            });
        }

        // Load pagination
        function loadPagination(limit, offset) {
            let jenis_kas = 'all';
            offset = typeof offset !== 'undefined' ? offset : 0;
            let page = offset * limit;
            $.ajax({
                url: '<?= base_url(); ?>manajemen/buku/getData/' + offset,
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    // page: page,
                    url_pagination: 'DataBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {

                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_buku = response.data.buku;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination').html(response.data.pagination_link);
                    $('ul.pagination li a').addClass('page-link');
                    createTable(data_buku, total_data, limit, offset);
                }
            });
        }

        function createTable(data_buku, total_data, limit, offset) {
            let htmlx = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();
            if (data_buku != 0) {
                let no = 1;
                let numEnd = Number(limit) + Number(offset);
                $('#datatable_info').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Record`);
                $.each(data_buku, function(k, v) {
                    htmlx += `<tr>`;
                    htmlx += `<td>${no++}</td>`;
                    htmlx += `<td class="text-center"><small>${v.nama_kategori}</small></td>`;
                    htmlx += `<td class="text-center"><small>${v.judul_buku}</small></td>`;
                    htmlx += `<td class="text-center"><small>${v.penulis_buku}</small></td>`;
                    htmlx += `<td class="text-center"><small>${v.penerbit_buku}</small></td>`;
                    htmlx += `<td class="text-center"><small>${v.tahun_penerbit}</small></td>`;
                    htmlx += `<td class="text-center"><small>${v.jumlah-v.jml_dipinjam}</small></td>`;
                    htmlx += `<td class="text-center"><img class="cover" width="40" height="60" src="<?= base_url('assets/img/coverbuku') ?>/${v.img}" data-judul="${v.judul_buku}" alt="Italian Trulli"></td>`;
                    htmlx += `</tr>`;
                });
                no++;
            } else {
                htmlx += `<tr>`;
                htmlx += `<td colspan="12" class="text-center"><br>`;
                htmlx += `<div class='col-lg-12'>`;
                htmlx += `<div class='alert alert-danger alert-dismissible'>`;
                htmlx += `<h4><i class='icon fa fa-warning'></i> Data tidak ditemukan!</h4>`;
                htmlx += `</div>`;
                htmlx += `</div>`;
                htmlx += `</td>`;
                htmlx += `</tr>`;
            }
            $('#tbody_buku').html(htmlx);
            $('img.cover').click(function() {
                let src = $(this).attr('src');
                let judul = $(this).attr('data-judul');
                $('#image_show').find('.judul-buku').text(judul)
                $('#image_show .modal-body img').attr('src', src);
                $('#image_show').modal('show');
            });
        }

        $.ajax({
            url: '<?= base_url(); ?>transaksi/peminjaman/getDataPeminjamanOneUser',
            type: 'POST',
            data: {
                username: key
            },
            serverSide: true,
            dataType: 'json',
            success: function(response) {
                // console.log(response.data);
                let data_peminjaman = response.data.peminjaman;
                let html = ``;
                if (data_peminjaman.length > 0) {
                    let no = 1;
                    $.each(data_peminjaman, function(k, item) {
                        html += `<tr>`;
                        html += `<td><small>${no}</small></td>`;
                        html += `<td>`;
                        $.each(item.buku_dipinjam, function(j, item_buku) {
                            html += `<i style="font-size:11px; font-weight: bold;">- ${item_buku.judul_buku}</i><br>`;
                        });
                        html += `</td>`;
                        html += `<td><small>${item.tanggal_pinjam} s/d ${item.tanggal_kembali}</small></td>`;
                        html += `<td><small>${item.nama_anggota}</small></td>`;
                        html += `<td><small>${item.nama_petugas}</small></td>`;
                        html += `<td><small>${item.jml_hari_denda}</small></td>`;
                        html += `<td><small>Rp.${parseInt(item.denda_telat).toLocaleString()}</small></td>`;
                        html += `</tr>`;
                        no++;
                    });
                } else {
                    html += `<tr>`;
                    html += `<td colspan="7" class="text-center"><i>Tidak ada data</i></td>`;
                    html += `</tr>`;
                }
                $('#tbody_peminjaman_buku').html(html);
            }
        });

        $('table#table_peminjaman').DataTable({
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, 'All'],
            ],
        });

        $('.btn_qrcode').on('click', function() {
            let data = $(this).data('img')
            Swal.fire({
                title: `<strong>SCAN DISINI</strong>`,
                imageUrl: `<?= base_url('assets/img/qrcode/') ?>${data}`,
                imageHeight: 400,
                imageWidth: 600,
                imageAlt: 'A tall image',
            })
            // alert(data);
        });
    });
</script>