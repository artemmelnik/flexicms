<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Mail\Exception;

use Flexi;

/**
 * Class SendException
 * @package Flexi\Mail\Exception
 */
class SendException extends Flexi\Exception\FlexiException
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Flexi Mail SendException';
    }
}
