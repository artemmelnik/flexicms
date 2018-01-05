<?php
namespace Flexi\Mokko;

use RecursiveArrayIterator;

/**
 * Class NestedKeyIterator
 * @package Flexi\Mokko
 */
class NestedKeyIterator extends \RecursiveIteratorIterator
{
    /**
     * @var array
     */
    private $stack = [];

    /**
     * @var string
     */
    private $keySeparator;

    /**
     * @param \Traversable $iterator
     * @param string $separator
     * @param int $mode
     * @param int $flags
     */
    public function __construct(\Traversable $iterator, $separator = '.', $mode = \RecursiveIteratorIterator::LEAVES_ONLY, $flags = 0)
    {
        $this->keySeparator = $separator;
        parent::__construct($iterator, $mode, $flags);
    }

    /**
     * {@inheritdoc}
     */
    public function callGetChildren()
    {
        $this->stack[] = parent::key();
        return parent::callGetChildren();
    }

    /**
     * {@inheritdoc}
     */
    public function endChildren()
    {
        parent::endChildren();
        array_pop($this->stack);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        $keys = $this->stack;
        $keys[] = parent::key();

        return implode($this->keySeparator, $keys);
    }
}
