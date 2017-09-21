<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>Login to FlexiCMS</title>

    <link href="/admin/Assets/semantic/semantic.min.css" rel="stylesheet">
    <link href="/admin/Assets/semantic/components/grid.min.css" rel="stylesheet">
    <link href="/admin/Assets/semantic/components/form.min.css" rel="stylesheet">
    <link href="/admin/Assets/semantic/components/checkbox.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/admin/Assets/css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <form class="ui form form-login" method="POST" action="/admin/auth/">
                <div class="fexi-login-logo">
                    <img class="ui middle aligned tiny image" src="/admin/Assets/images/logo.png">
                    <span>ADMIN PANEL</span>
                </div>
                <div class="field">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="field inline">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0">
                        <label>Remember me</label>
                    </div>
                </div>
                <button class="ui primary button">
                    Login
                </button>
            </form>
        </div>
    </div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/admin/Assets/js/jquery-2.0.3.min.js"></script>
<script src="/admin/Assets/semantic/semantic.min.js"></script>
<script src="/admin/Assets/semantic/components/form.min.js"></script>
<link href="/admin/Assets/semantic/components/checkbox.min.js" rel="stylesheet">
</body>
</html>