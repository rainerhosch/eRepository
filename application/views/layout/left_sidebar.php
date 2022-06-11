<style>
    .left-side-menu {
        backdrop-filter: blur(11px);
        width: 240px;
        background: #828ed566;
        bottom: 0;
        padding: 20px 0;
        position: fixed;
        transition: all .1s ease-out;
        top: 70px;
        box-shadow: 0 0 35px 0 rgb(154 161 171 / 15%);
    }
</style>
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <!-- <div class="user-box text-center">
            <img src="<?= base_url('assets/template') ?>/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown" aria-expanded="false">Nowak Helme</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
            <p class="text-muted left-user-info">Admin Head</p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="#">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div> -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<script>
    $(document).ready(function() {
        var roleUserLogin = '<?= $this->session->userdata('role'); ?>';
        $.ajax({
            url: "<?= base_url() ?>manajemen/user/get_user_acces_menu",
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                let curren_url = window.location.href;
                let segmeng_url = curren_url.split('/');
                // console.log(response);
                let html = ``;
                let menuActive = ``;
                $.each(response.data, function(i, v) {
                    if (segmeng_url[4] === v.link_menu) {
                        html += `<li class="menuitem-active" id="${v.link_menu}">`;
                    } else {
                        html += `<li id="${v.link_menu}">`;
                    }
                    if (v.type === '1') {
                        html += `<a href="<?= base_url() ?>${v.link_menu}">${v.icon}
                        <span> ${v.nama_menu} </span></a>`;
                    } else {
                        html += `<a href="#li-${v.link_menu}" data-bs-toggle="collapse">${v.icon}
                                    <span> ${v.nama_menu} </span>
                                    <span class="menu-arrow"></span>
                                </a>`;
                        html += `<div class="collapse" id="li-${v.link_menu}">`;
                        $.each(v.submenu, function(i, val) {
                            let icon_submenu = ``;
                            if (val.icon_status === '1') {
                                icon_submenu += val.icon;
                            }
                            if (roleUserLogin != 1) {
                                if (val.url != 'manajemen/roleuser') {
                                    html += `<ul class="nav-second-level">
                                                    <li>
                                                        <a href="<?= base_url() ?>${val.url}" id="${val.nama_submenu}" class="">${icon_submenu} ${val.nama_submenu}</a>
                                                    </li>`;
                                    html += `</ul>`;
                                }
                            } else {
                                html += `<ul class="nav-second-level">
                                                    <li>
                                                        <a href="<?= base_url() ?>${val.url}" id="${val.nama_submenu}" class="">${icon_submenu} ${val.nama_submenu}</a>
                                                    </li>`;
                                html += `</ul>`;
                            }
                        });
                        html += `</div>`;
                    }
                    html += `</li>`;
                });
                $("ul#side-menu").html(html);
                if ($('li').hasClass('menuitem-active')) {
                    let submenuAktif = segmeng_url[segmeng_url.length - 1];
                    $this = $('li.menuitem-active').attr('id');
                    let id = 'li-' + $this;
                    $('div#' + id).addClass('show');

                    str = submenuAktif.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('a#' + str).addClass('active');
                }
            }
        });
    });
</script>