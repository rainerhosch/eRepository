<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data <?= $subpage; ?></h4>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <button class="btn float-end btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddRole"><i class="mdi mdi-plus me-1"></i>Add <?= $subpage; ?></button>
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
                        </div>
                        <div class="col-xl-10 col-sm-10 col-xs-12">
                            <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="Cari data" aria-controls="datatable"></div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tableBuku">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">KATEGORI</th>
                                    <th class="text-center">JUDUL</th>
                                    <th class="text-center">PENULIS</th>
                                    <th class="text-center">PENERBIT</th>
                                    <th class="text-center">TAHUN TERBIT</th>
                                    <th class="text-center">JUMLAH</th>
                                    <th class="text-center">COVER</th>
                                    <th class="text-center">TOOLS</th>
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
                            <div class="dataTables_paginate paging_simple_numbers" id="pagination">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" tabindex="-1" role="dialog" id="image_show">
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
            // console.log(limit);
            // console.log(data_buku);
            let htmlx = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();

            if (data_buku != 0) {
                let no = 1;
                let numEnd = Number(limit) + Number(offset);
                $('#datatable_info').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Record`);
                $.each(data_buku, function(k, v) {
                    htmlx += `
                        <tr>
                            <td>${no++}</td>
                            <td class="text-center">${v.nama_kategori}</td>
                            <td class="text-center">${v.judul_buku}</td>
                            <td class="text-center">${v.penulis_buku}</td>
                            <td class="text-center">${v.penerbit_buku}</td>
                            <td class="text-center">${v.tahun_penerbit}</td>
                            <td class="text-center">${v.jumlah}</td>
                            <td class="text-center"><img class="cover" width="40" height="60" src="<?= base_url('assets/img/coverbuku') ?>/${v.img}" data-judul="${v.judul_buku}" alt="Italian Trulli"></td>
                            <td class="text-center">
                                <button class="btn btn-outline-warning rounded-pill waves-effect waves-light btn-xs" id="btnEditRole" data-id="${v.id_buku}"><i class="mdi mdi-pencil-outline"></i></button>
                                <button class="btn btn-outline-danger rounded-pill waves-effect waves-light btn-xs" id="btnDeleteRole" data-id="${v.id_buku}"><i class="mdi mdi-delete"></i></button>
                            </td>
                        </tr>
                    `;
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
    });
</script>