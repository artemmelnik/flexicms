<?php
namespace Flexi\Orm\Exception;

use Exception;

/**
 * Class ModelException
 * @package Flexi\Orm\Exception
 */
class ModelException extends Exception
{
    public function getName() {
        return 'OrmModelException';
    }
}
