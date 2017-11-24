<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Admin panel</title>

    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/semantic.min.css') ?>">
    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/components/dropdown.min.css') ?>">
    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/components/transition.min.css') ?>">
    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/components/icon.min.css') ?>">
    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/components/segment.min.css') ?>">
    <link rel="stylesheet" href="<?php echo Asset::get('assets/semantic/components/sidebar.min.css') ?>">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo Asset::get('assets/css/dashboard.css') ?>">

    <!-- simplelineicons for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- Redactor CSS -->
    <link rel="stylesheet" href="<?php echo Asset::get('assets/js/plugins/redactor/redactor.css') ?>">
</head>
<body>
<header>
    <div class="ui borderless main menu top-header">
        <div class="ui container">
            <div href="/admin/" class="header item logo-item">
                <img class="logo" src="<?php echo Asset::get('assets/images/logo.png') ?>">
            </div>

            <?php foreach (Customize::instance()->getAdminMenuItems() as $key => $item): ?>
                <a class="item" href="<?= $item['urlPath'] ?>">
                    <i class="<?= $item['classIcon'] ?>"></i>
                    <?= $item['title'] ?>
                </a>
            <?php endforeach; ?>

            <a href="/admin/logout/" class="ui right floated item" tabindex="0">
                <i class="icon-logout icons"></i> Logout
            </a>
        </div>
    </div>
</header>

<?php echo Layout::content(); ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo Asset::get('assets/js/jquery-2.0.3.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/semantic/semantic.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/semantic/components/transition.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/semantic/components/dropdown.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/semantic/components/sidebar.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/plugins/redactor/redactor.min.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/jquery-sortable.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/init.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/page.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/post.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/setting.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/menu.js') ?>"></script>
<script src="<?php echo Asset::get('assets/js/plugin.js') ?>"></script>
</body>
</html>