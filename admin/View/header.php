<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Админ-панель</title>

    <link href="/admin/Assets/semantic/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/dropdown.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/transition.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/icon.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/segment.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/sidebar.min.css">


    <!-- Custom styles for this template -->
    <link href="/admin/Assets/css/dashboard.css" rel="stylesheet">

    <!-- simplelineicons for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- Redactor CSS -->
    <link rel="stylesheet" href="/admin/Assets/js/plugins/redactor/redactor.css">
</head>
<body>
<header>
    <div class="ui borderless main menu top-header">
        <div class="ui container">
            <div href="/admin/" class="header item logo-item">
                <img class="logo" src="/admin/Assets/images/logo.png">
            </div>
            <a href="/admin/" class="item">
                <i class="icon-speedometer icons"></i>
                <?= $lang->dashboardMenu['home'] ?>
            </a>
            <a href="/admin/pages/" class="item">
                <i class="icon-doc icons"></i>
                <?= $lang->dashboardMenu['pages'] ?>
            </a>
            <a href="/admin/posts/" class="item">
                <i class="icon-pencil icons"></i>
                <?= $lang->dashboardMenu['posts'] ?>
            </a>
            <a href="/admin/settings/general/" class="item">
                <i class="icon-equalizer icons"></i>
                <?= $lang->dashboardMenu['settings'] ?>
            </a>

            <a href="/admin/logout/" class="ui right floated item" tabindex="0">
                <i class="icon-logout icons"></i> Logout
            </a>
        </div>
    </div>
</header>