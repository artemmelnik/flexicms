<?php

namespace Engine\Core\Template;

use Admin\Model\Setting\SettingRepository;
use Engine\DI\DI;

/**
 * Class Setting
 * @package Engine\Core\Template
 */
class Setting
{
    /**
     * @var DI
     */
    protected static $di;

    /**
     * @var SettingRepository
     */
    protected static $settingRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$settingRepository = new SettingRepository(self::$di);
    }

    /**
     * @param string $keyField
     * @return null|string
     */
    public static function get($keyField)
    {
        return self::$settingRepository->getSettingValue($keyField);
    }
}
