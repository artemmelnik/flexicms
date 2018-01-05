<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Mail\Transport;

use Flexi\Mail\Message;

/**
 * Class AbstractTransport
 * @package Flexi\Mail\Transport
 */
abstract class AbstractTransport
{
    /**
     * @param Message $mail
     * @return bool
     */
    public function sending(Message $mail)
    {
        if (!mail('artemmelnik989@gmail.com', 'subject', 'message')) {
            return false;
        }

        return true;
    }
}
