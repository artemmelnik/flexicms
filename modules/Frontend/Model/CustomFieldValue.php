<?php
namespace Modules\Frontend\Model;

use Flexi;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomFieldValue
 * @package Modules\Frontend\Model
 */
class CustomFieldValue extends Model
{
    /**
     * @var string
     */
    protected static $table = 'custom_field_value';
}
