<?php
/**
 * This file is part of the FlexiCMS Framework (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */
declare(strict_types=1);

namespace Flexi\Mail;

/**
 * Interface InterfaceMailer
 * @package Flexi\Mail
 */
interface InterfaceMailer
{
    /**
     * @param Message $mail
     */
    function send(Message $mail): void;
}