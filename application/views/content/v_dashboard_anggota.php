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
    </div>
</div>
<script>
    $(document).ready(function() {
        var key = `<?= $this->session->userdata('username') ?>`;
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
                $('#table_peminjaman').DataTable({
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All'],
                    ],
                });
            }
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