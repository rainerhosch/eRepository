<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $page; ?> | <?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/template') ?>/images/favicon.ico">
    <!-- third party css -->
    <link href="<?= base_url('assets/template') ?>/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url('assets/template') ?>/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/daterangepicker/css/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- select css -->
    <link href="<?= base_url('assets/template') ?>/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template') ?>/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

    <!-- third party css end -->
    <!-- App css -->
    <link href="<?= base_url('assets/template') ?>/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled" />
    <!-- icons -->
    <link href="<?= base_url('assets/template') ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/template'); ?>/libs/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
    <!-- Vendor js -->
    <script src="<?= base_url('assets/template') ?>/js/vendor.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/template') ?>/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/template') ?>/libs/daterangepicker/js/moment.min.js"></script>
    <script src="<?= base_url('assets/template') ?>/libs/daterangepicker/js/daterangepicker.js"></script>
    <!-- select js -->
    <script src="<?= base_url('assets/template') ?>/libs/selectize/js/standalone/selectize.min.js"></script>
    <script src="<?= base_url('assets/template') ?>/libs/multiselect/js/jquery.multi-select.js"></script>
    <script src="<?= base_url('assets/template') ?>/libs/select2/js/select2.min.js"></script>

</head>

<!-- body start -->
<!-- <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "condensed", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'> -->
<?php if ($page == 'Auth') : ?>

    <body class="loading authentication-bg authentication-bg-pattern">
        <?php $this->load->view($content); ?>
    <?php else : ?>

        <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
            <!-- Begin page -->
            <div id="wrapper">
                <?php $this->load->view('layout/topbar'); ?>
                <?php $this->load->view('layout/left_sidebar'); ?>
                <div class="content-page">
                    <?php $this->load->view($content); ?>
                    <?php $this->load->view('layout/footer'); ?>
                </div>
            </div>
            <div class="rightbar-overlay"></div>

        <?php endif; ?>

        <!-- knob plugin -->
        <script src="<?= base_url('assets/template') ?>/libs/jquery-knob/jquery.knob.min.js"></script>
        <!-- third party js -->
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="<?= base_url('assets/template') ?>/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="<?= base_url('assets/template') ?>/js/pages/datatables.init.js"></script>

        <!-- App js-->
        <script src="<?= base_url('assets/template') ?>/js/app.min.js"></script>
        </body>

</html>