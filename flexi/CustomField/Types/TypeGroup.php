<?php
namespace Flexi\CustomField\Types;

/**
 * Class TypeGroup
 * @package Flexi\CustomField\Types
 */
class TypeGroup
{
    const POST_TYPE = 'post';
    const PAGE_TYPE = 'page';
    const USER_TYPE = 'user';
    const ARRAY_GROUP_TYPES = [
        self::PAGE_TYPE,
        self::POST_TYPE,
        self::USER_TYPE
    ];
}
