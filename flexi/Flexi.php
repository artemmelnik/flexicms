<?php
namespace Flexi;

use Flexi\Auth\Auth;
use Flexi\Database\Database;
use Flexi\Facades\Session;
use Flexi\Http\Uri;

/**
 * Class Flexi
 * @package Flexi
 */
class Flexi
{
    /**
     * Startup the system.
     *
     * @return void
     */
    public static function start()
    {
        // Check aliases.
        class_alias('\\Flexi\\Template\\Component', 'Component');
        class_alias('\\Flexi\\Routing\\Controller', 'Controller');
        class_alias('\\Flexi\\Template\\Layout', 'Layout');
        class_alias('\\Flexi\\Orm\\Query', 'Query');
        class_alias('\\Flexi\\Routing\\Route', 'Route');
        class_alias('\\Flexi\\Template\\View', 'View');
        class_alias('\\Flexi\\Template\\Asset', 'Asset');
        class_alias('\\Flexi\\Settings\\Setting', 'Setting');
        class_alias('\\Flexi\\Customize\\Customize', 'Customize');
        class_alias('\\Flexi\\DI\\Container', 'DI');
        class_alias('\\Modules\\Front\\Classes\\Page', 'Page');
        class_alias('\\Modules\\Front\\Classes\\Field', 'Field');
        class_alias('\\Modules\\Front\\Classes\\Post', 'Post');

        // Initialize the URI.
        Uri::initialize();

        // Attempt a database connection.
        Database::initialize();

        // Initialize the session.
        Session::initialize();

        // Initialize auth.
        Auth::initialize();
    }

    /**
     * Close the system.
     *
     * @return void
     */
    public static function close()
    {
        Database::finalize();
    }
}
