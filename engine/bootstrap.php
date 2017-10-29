<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (version_compare($ver = PHP_VERSION, $req = FLEXI_PHP_MIN, '<')) {
    die(sprintf('You are running PHP %s, but Flexi needs at least PHP %s to run.', $ver, $req));
}

class_alias('Engine\\Core\\Template\\Asset', 'Asset');
class_alias('Engine\\Core\\Template\\Theme', 'Theme');
class_alias('Engine\\Core\\Template\\Setting', 'Setting');
class_alias('Engine\\Core\\Template\\Menu', 'Menu');
class_alias('Engine\\Core\\Customize\\Customize', 'Customize');
class_alias('Engine\\Helper\\Lang', 'Lang');

use Engine\Cms;
use Engine\DI\DI;

try{
    // Dependency injection
    $di = new DI();

    $services = require __DIR__ . '/Config/Service.php';

    // Init services
    foreach ($services as $service) {
        $provider = new $service($di);

        /** @var \Engine\Service\AbstractProvider $provider */
        $provider->init();
    }

    // Init models
    $di->set('model', []);

    $cms = new Cms($di);
    $cms->run();

} catch (\ErrorException $e) {
    echo $e->getMessage();
}
