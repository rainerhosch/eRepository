<style>
    .form-control {
        display: block;
        width: 100%;
        padding: 0.45rem 0.9rem;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6c757d;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        -webkit-appearance: none;
        appearance: none;
        border-radius: 15.2rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .btn {
        border-radius: 15.2rem;
    }

    .btn-primary {
        color: #fff;
        background-color: #5b69bc !important;
        border-color: #ffffff00;
    }

    .card {
        margin-top: 20rem;
        backdrop-filter: blur(5px);
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #6d8a992e;
        background-clip: border-box;
        border: 0 solid #f7f7f7;
        border-radius: 0.25rem;
    }

    /* .togglePassword {
        margin-left: -30px;
        cursor: pointer;
    } */

    body .password-filed {
        position: relative;
    }

    body .password-filed input {
        letter-spacing: 1px;
    }

    body .password-filed #togglePassword {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-book-open" style="font-size: 24px;"></i>
                            <h3 class="mt-0" style="color:#7b80859c;">eLibrary</h3>
                            <h5 style="color:#7b80859c;">SISTEM PERPUSTAKAAN ELEKTRONIK</h5>
                            <h5 style="color:#7b80859c;">SMA NEGRI 6 KOTA SERANG</h5>
                        </div>

                        <hr>
                        <div class="row" id="alert_msg">
                            <div class="col-12">
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                        <form action="#" id="form-regist">

                            <!-- <div class="form-group row">
                                <label for=" role_user" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="role_user_show" name="role_user_show" value="Anggota" disabled> -->
                            <input type="hidden" class="form-control" id="role_user" name="role_user" value="4">
                            <!-- </div>
                            </div> -->
                            <div class="form-group row  mt-1">
                                <label for=" nama_user" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="alamat_user" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="email_user" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="tlp_user" class="col-sm-2 col-form-label">No Tlp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tlp_user" name="tlp_user" placeholder="No Tlp/Handphone" required>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10 password-filed">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <span><i class="far fa-eye-slash" id="togglePassword" hidden></i></span>
                                </div>
                                <!-- <div class="col-sm-1 text-center mt-2">
                                    <i class="far fa-eye-slash togglePassword" id="togglePassword"></i>
                                </div> -->
                            </div>
                            <div class="mt-3 d-grid text-center">
                                <button class="btn btn-primary" type="submit"> Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-dark">Already have account? <a href="login" class="text-dark ms-1"><b>Sign In</b></a></p>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var togglePassword = document.querySelector('#togglePassword');
        var password = document.querySelector('#password');
        showHidePassword = () => {
            if (password.type == 'password') {
                password.setAttribute('type', 'text');
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
                // console.log(togglePassword.classList)
            } else {
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
                password.setAttribute('type', 'password');
                // console.log(togglePassword.classList)
            }
        };
        togglePassword.addEventListener('click', showHidePassword);
        $('input#password').on('input', function() {
            let data = $(this).val();
            if (data != '') {
                $('#togglePassword').prop('hidden', false);
            } else {
                $('#togglePassword').prop('hidden', true);
            }
        })


        setTimeout(function() {
            $("#alert_msg").html("");
        }, 2000);
        $('#form-regist').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            // console.log(form.serializeArray());
            // console.log(form);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/auth/process_registration",
                data: form.serializeArray(),
                dataType: "json",
                success: function(response) {
                    // console.log(response);
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