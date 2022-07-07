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

<!-- Modal Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit_user" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nama_user" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="user_id" name="user_id">
                            <input type="hidden" class="form-control" id="user_detail_id" name="user_detail_id">
                            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama Lengkap" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="alamat_user" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="email_user" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="tlp_user" class="col-sm-4 col-form-label">No Tlp</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tlp_user" name="tlp_user" placeholder="No Tlp/Handphone" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="change_password" class="col-sm-4 col-form-label">Ubah Password</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Default select" id="ubah_password">
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-1 div_password" hidden>
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="password_lama" name="password_lama" value="" required>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary btn_save_role_user" style="float: right;">Simpan</button>
                        </div>
                    </div>
                </form>
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
        $('.btn_edit_profile').on('click', function() {
            var user_id = `<?= $this->session->userdata('user_id') ?>`;
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>manajemen/user/getDataById",
                data: {
                    id: user_id
                },
                dataType: "json",
                success: function(response) {
                    let data_user = response.data;
                    console.log(data_user)
                    $('#user_id').val(data_user.user_id)
                    $('#user_detail_id').val(data_user.user_detail_id)
                    $('#nama_user').val(data_user.nama)
                    $('#alamat_user').val(data_user.alamat)
                    $('#email_user').val(data_user.email)
                    $('#tlp_user').val(data_user.tlp)
                    $('#password_lama').val(data_user.password)
                    $('#exampleModal').modal('show');

                    $('#ubah_password').on('change', function() {
                        let data = $(this).val();
                        console.log(data)
                        if (data === '2') {
                            $('.div_password').prop('hidden', false);
                            $('#password_baru').prop('disabled', false);
                            $('#password_baru').prop('required', true);
                        } else {
                            $('.div_password').prop('hidden', true);
                            $('#password_baru').prop('disabled', true);
                            $('#password_baru').prop('required', false);
                        }
                    });
                }
            })
        });

        $("#form_edit_user").submit(function(e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            // console.log(form_data)
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>manajemen/user/updateData",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let icon = ``;
                    let title = ``;
                    let text = ``;
                    if (response.code === 200) {
                        icon = `success`;
                        title = `Success`;
                    } else {
                        icon = `error`;
                        title = `Error`;
                    }
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: response.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(isConfirm) {
                        location.reload()
                    });
                }
            });
        });

    });
</script>