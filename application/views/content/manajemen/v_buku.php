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
                                <button class="btn float-end btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btnAddBuku"><i class="mdi mdi-plus me-1"></i>Add <?= $subpage; ?></button>
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

    <!-- Modal Add Buku -->
    <div class="modal fade" id="modalAddBuku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_buku" enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manajemen/buku/addBuku">
                        <div class="form-group row">
                            <label for="input_kategori" class="col-sm-3 col-form-label">Kategori Buku</label>
                            <div class="col-sm-9">
                                <select id="input_kategori" name="input_kategori" class="form-select parsley-success" required data-parsley-id="21">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_kode_buku" class="col-sm-3 col-form-label">Kode Buku</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_kode_buku" name="input_kode_buku" placeholder="Kode buku" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_kode_judul" class="col-sm-3 col-form-label">Kode Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_kode_judul" name="input_kode_judul" placeholder="Kode judul" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_judul" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_judul" name="input_judul" placeholder="Judul Buku" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_penulis" class="col-sm-3 col-form-label">Penulis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_penulis" name="input_penulis" placeholder="Penulis buku" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_penerbit" name="input_penerbit" placeholder="Penerbit buku" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_tahun_terbit" name="input_tahun_terbit" placeholder="Tahun Terbit" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_jumlah" name="input_jumlah" placeholder="Jumlah buku" required>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_cover" class="col-sm-3 col-form-label">Cover Buku</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="input_cover" name="files">
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
    <!-- End Modal -->
</div>

<script>
    $(document).ready(function() {
        $('input[name="input_tahun_terbit"').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#btnAddBuku').click(function() {
            $.ajax({
                url: '<?= base_url(); ?>manajemen/buku/getKategori',
                type: 'POST',
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    let html = ``;
                    html += `<option value="" hidden>Pilih Kategori</option>`;
                    $.each(response.data, function(i, item) {
                        html += `<option value="${item.id_kategori}">${item.nama_kategori}</option>`;
                    });
                    $('select#input_kategori').html(html);
                    // console.log(response);
                }
            });
            $('#modalAddBuku').modal('show');
        });


        $('.btn_save_buku').click(function() {
            console.log(123);
            // $.ajax({
            //     url: '<?= base_url(); ?>manajemen/buku/addBuku',
            //     type: 'POST',
            //     data: $('form#form_add_buku').serialize(),
            //     dataType: 'json',
            //     success: function(response) {
            // if (response.status == 'success') {
            //     Swal.fire({
            //         title: 'Success',
            //         text: 'Data berhasil disimpan',
            //         type: 'success',
            //         confirmButtonText: 'Ok'
            //     });
            //     $('#modalAddBuku').modal('hide');
            //     $('#table_buku').DataTable().ajax.reload();
            // } else {
            //     Swal.fire({
            //         title: 'Error',
            //         text: 'Data gagal disimpan',
            //         type: 'error',
            //         confirmButtonText: 'Ok'
            //     });
            // }
            //     }
            // });
        });




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
                                <button class="btn btn-outline-warning rounded-pill waves-effect waves-light btn-xs btnEditBuku" data-id="${v.id_buku}" data-judul="${v.judul_buku}"><i class="mdi mdi-pencil-outline"></i></button>
                                <button class="btn btn-outline-danger rounded-pill waves-effect waves-light btn-xs btnDeleteBuku" data-id="${v.id_buku}" data-judul="${v.judul_buku}"><i class="mdi mdi-delete"></i></button>
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

            $('.btnEditBuku').on('click', function() {
                let id_buku = $(this).data('id');
                console.log('edit' + id_buku);
            });
            $('.btnDeleteBuku').on('click', function() {
                let id_buku = $(this).data('id');
                let judul = $(this).data('judul');
                console.log('delete' + id_buku);
                // Swal.fire({
                //     title: 'Are you sure?',
                //     text: `Buku ${judul} , akan dihapus!`,
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes, delete it!'
                // }).then((result) => {
                //     console.log(result);
                //     if (result.isConfirmed) {
                //         $.ajax({
                //             type: "POST",
                //             url: "<?= base_url(); ?>manajemen/buku/deleteData", // where you wanna post
                //             data: {
                //                 id: id_buku
                //             },
                //             dataType: "json",
                //             success: function(response) {
                //                 // console.log(response)
                //                 let title = ``;
                //                 let msg = ``;
                //                 let icon = ``;
                //                 if (response.code === 200) {
                //                     title = `Deleted`;
                //                     icon = `success`;
                //                 } else {
                //                     title = `Error!`;
                //                     icon = `error`;
                //                 }
                //                 Swal.fire(
                //                     title,
                //                     response.msg,
                //                     icon
                //                 )
                //                 location.reload();
                //             }
                //         })
                //     }
                // })
            });
        }
    });
</script>