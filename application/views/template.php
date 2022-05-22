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
    <!-- App css -->
    <link href="<?= base_url('assets/template') ?>/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled" />
    <link href="<?= base_url('assets/template') ?>/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled" />
    <!-- icons -->
    <link href="<?= base_url('assets/template') ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- Vendor js -->
    <script src="<?= base_url('assets/template') ?>/js/vendor.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<!-- body start -->
<!-- <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "condensed", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'> -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "dark", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
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

    <!-- knob plugin -->
    <script src="<?= base_url('assets/template') ?>/libs/jquery-knob/jquery.knob.min.js"></script>
    <!-- App js-->
    <script src="<?= base_url('assets/template') ?>/js/app.min.js"></script>
</body>

</html>