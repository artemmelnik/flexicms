<?php
error_reporting(E_ERROR);

require_once __DIR__ . '/../vendor/autoload.php';

if (version_compare($ver = PHP_VERSION, $req = FLEXI_PHP_MIN, '<')) {
    die(sprintf('You are running PHP %s, but Flexi needs at least PHP %s to run.', $ver, $req));
}

$request = new \Engine\Core\Request\Request();

$isInstall = false;

if (is_file($request->server['DOCUMENT_ROOT'] . '/Cms/Config/database.php')) {
    $isInstall = true;
}

if ($request->get('delete_install') == 1) {
    if (\Engine\Helper\FileSystem::delTree($request->server['DOCUMENT_ROOT'] . '/install')) {
        header('Location: /');
        exit;
    }
}

if (!empty($request->post()) and $isInstall == false) {
    $config['host']     = $request->post('host');
    $config['db_name']  = $request->post('db_name');
    $config['username'] = $request->post('username');
    $config['password'] = $request->post('password');
    $config['charset']  = 'utf8';

    $result = [];

    if (!class_exists('\\PDO')) {
        $result['error'][] = 'The server does not have PDO installed';
    }

    $link = mysqli_connect($config['host'], $config['username'], $config['password'], $config['db_name']);
    if (!$link) {
        $result['error'][] = 'Could not connect to database';
    } else {
        mysqli_close($link);

        $sql = file_get_contents('flexicms.sql');

        $db = new \Engine\Core\Database\Connection($config);
        $db->execute($sql);

        $codeConfig = "<?php
return [
    'host'     => '{$config['host']}',
    'db_name'  => '{$config['db_name']}',
    'username' => '{$config['username']}',
    'password' => '{$config['password']}',
    'charset'  => '{$config['charset']}'
];";

        file_put_contents($request->server['DOCUMENT_ROOT'] . '/Admin/Config/database.php', $codeConfig);
        file_put_contents($request->server['DOCUMENT_ROOT'] . '/Cms/Config/database.php', $codeConfig);

        header('Location: /install/');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Artem Melnik">
    <link rel="shortcut icon" href="favicon.ico">

    <title>Install FlexiCMS</title>

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
        <?php if ($isInstall): ?>
        <div style="max-width: 350px; margin: auto">
            <div class="ui success message">
                <i class="close icon"></i>
                <div class="header">
                    Installation was successful.
                </div>
                <p>
                    Now we advise you to delete the directory of the installation and go to the site.
                </p>
                <a href="?delete_install=1" class="ui green button">
                    Delete install
                </a>
            </div>
        </div>
        <?php else: ?>
        <form class="ui form form-login" method="POST" action="/install/">
            <div class="fexi-login-logo">
                <img class="ui middle aligned tiny image" src="/admin/Assets/images/logo.png">
                <span>INSTALLATION</span>
            </div>
            <?php if (isset($result['error'])): ?>
            <div class="ui negative message transition">
                <i class="close icon"></i>
                <div class="header">
                    There were errors during the installation
                </div>
                <?php foreach ($result['error'] as $error): ?>
                <p>
                    <?php echo $error ?>
                </p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="field">
                <input type="text" name="host" placeholder="Host" value="<?php echo $request->post('host') ?>" required>
            </div>
            <div class="field">
                <input type="text" name="db_name" placeholder="Name Database" value="<?php echo $request->post('db_name') ?>" required>
            </div>
            <div class="field">
                <input type="text" name="username" placeholder="Username" value="<?php echo $request->post('username') ?>" required>
            </div>
            <div class="field">
                <input type="text" name="password" placeholder="Password" value="<?php echo $request->post('password') ?>">
            </div>
            <button class="ui primary button">
                Start Install
            </button>
        </form>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/admin/Assets/js/jquery-2.0.3.min.js"></script>
<script src="/admin/Assets/semantic/semantic.min.js"></script>
<script src="/admin/Assets/semantic/components/form.min.js"></script>
<script src="/admin/Assets/semantic/components/checkbox.min.js"></script>
</body>
</html>
