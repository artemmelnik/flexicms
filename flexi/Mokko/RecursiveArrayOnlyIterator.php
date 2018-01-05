<?php
namespace Flexi\Mokko;

/**
 * Class RecursiveArrayOnlyIterator
 * @package Flexi\Mokko
 */
class RecursiveArrayOnlyIterator extends \RecursiveArrayIterator
{
    /**
     * {@inheritdoc}
     */
    public function hasChildren()
    {
        return is_array($this->current()) || $this->current() instanceof \Traversable;
    }
}
