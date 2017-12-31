<?php

/**
 * @param string $key
 * @param array $data
 */
function __($key, $data = [])
{
    echo \Flexi\Localization\I18n::instance()->get($key, $data);
}

/**
 * @param string $key
 * @param array $data
 * @return string
 */
function __e($key, $data = [])
{
    return \Flexi\Localization\I18n::instance()->get($key, $data);
}
