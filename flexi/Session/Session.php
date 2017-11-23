<?php
namespace Flexi\Session;

/**
 * Class Session
 * @package Flexi\Session
 */
class Session
{

    /**
     * @var bool Session initialized.
     */
    protected static $initialized = false;

    /**
     * @var SessionDriver The active session driver.
     */
    protected static $driver;

    /**
     * Create new session.
     *
     * @return void
     */
    public function __construct()
    {
        // Does the session need to be initialized?
        if (!static::$initialized) {
            // Get the driver name from the application config and get the
            // class name for us to instantiate.
            $driver = 'native';
            $class  = 'Flexi\\Session\\Driver\\' . ucfirst(strtolower($driver));

            // Instantiate driver.
            static::$driver = new $class;

            // Initialize the session.
            if (static::driver()->initialize()) {
                static::$initialized = true;
            }
        }
    }

    /**
     * Destroys the session.
     *
     * @return void
     */
    public function __destruct()
    {
        static::driver()->finalize();
    }

    /**
     * Gets the active session driver.
     *
     * @return SessionInterface
     */
    public static function driver(): SessionInterface
    {
        return static::$driver;
    }

}
