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
</style>
<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-book-open" style="font-size: 24px;"></i>
                            <h3 class="mt-0" style="color:#7b80859c;">eLibrary</h3>
                            <h5 style="color:#7b80859c;">SISTEM PERPUSTAKAAN ELEKTRONIK</h5>
                            <h5 style="color:#7b80859c;">SMA NEGRI 6 KOTA SERANG</h5>
                        </div>
                        <div class="row" id="alert_msg">
                            <div class="col-12">
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                        <form action="#" id="form-login">
                            <div class="row">
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label for="email_or_username" class="form-label">Account</label>
                                        <input class="form-control" type="text" id="email_or_username" required="" name="email_or_username" placeholder="Enter username or your email">
                                    </div>
                                    <div class="col-12 notif_username">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="passwords" placeholder="Enter your password">
                                    </div>
                                    <div class="col-12 notif_password">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> -->
                            <div class="mb-3 d-grid text-center">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="#pages-recoverpw.html" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#alert_msg").html("");
        }, 2000);
        $('#form-login').on('submit', function(e) {
            e.preventDefault();
            var email_or_username = $('#email_or_username').val();
            var password = $('#password').val();
            $.ajax({
                url: "<?= base_url('auth') ?>/process_login",
                type: "POST",
                data: {
                    email_or_username: email_or_username,
                    password: password
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    if (response.code != 200) {
                        if (response.code === 403) {
                            $('.notif_password').html(`<p class="text-danger"><small>${response.message}</small></p>`);
                            setTimeout(function() {
                                $('.notif_password').html(``);
                            }, 2000);
                        } else {
                            // 404 & 402
                            $('.notif_username').html(`<p class="text-danger"><small>${response.message}</small></p>`);
                            setTimeout(function() {
                                $('.notif_username').html(``);
                            }, 2000);
                        }
                    } else {
                        // 200
                        window.location = `<?= base_url('dashboard') ?>`
                    }
                }
            });
        });
    });
</script>