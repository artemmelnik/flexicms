<?php

/**
 * @param string $key
 */
function __($key)
{
    echo \Flexi\Localization\I18n::instance()->get($key);
}

/**
 * @param string $key
 * @return string
 */
function __e($key)
{
    return \Flexi\Localization\I18n::instance()->get($key);
}
