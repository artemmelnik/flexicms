<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Mail;

use Flexi;

/**
 * Class Mailer
 * @package Flexi\Mail
 */
class Mailer implements InterfaceMailer
{
    const NAMESPACE_COMPONENT = 'Flexi\\Mail\\Transport\\%s';

    /**
     * @var InterfaceMailer
     */
    protected $transport;

    /**
     * Mailer constructor.
     * @param string $nameTransport
     * @param array $config
     */
    public function __construct(string $nameTransport = 'Mail', array $config = [])
    {
        $transport = sprintf(self::NAMESPACE_COMPONENT, $nameTransport);

        /**
         * @var InterfaceMailer $transport
         */
        $this->transport = new $transport;
    }

    /**
     * @param Message $mail
     */
    function send(Message $mail): void
    {
        // TODO: Implement send() method.
        $this->transport->send($mail);
    }
}
