<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Exception;

/**
 * Class FlexiException
 * @package Flexi\Exception
 */
class FlexiException extends \Exception
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'FlexiException';
    }
}
