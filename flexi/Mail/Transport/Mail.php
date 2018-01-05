<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Mail\Transport;

use Flexi\Mail\InterfaceMailer;
use Flexi\Mail\Message;

/**
 * Class Mail
 * @package Flexi\Mail\Transport
 */
class Mail extends AbstractTransport implements InterfaceMailer
{
    /**
     * @param Message $mail
     */
    public function send(Message $mail): void
    {
        // TODO: Implement send() method.
        $this->sending($mail);
    }
}
