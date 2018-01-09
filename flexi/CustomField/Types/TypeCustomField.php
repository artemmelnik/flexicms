<?php
namespace Flexi\CustomField\Types;

/**
 * Class TypeCustomField
 * @package Flexi\CustomField\Types
 */
class TypeCustomField
{
    const TYPE_TEXT = 'text';
    const TYPE_NUMBER = 'number';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_EMAIL = 'email';
    const ARRAY_FIELD_TYPES = [
        self::TYPE_TEXT,
        self::TYPE_NUMBER,
        self::TYPE_EMAIL,
        self::TYPE_TEXTAREA
    ];
}
