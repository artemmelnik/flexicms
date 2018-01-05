<?php
namespace Flexi\Mokko;

/**
 * Class Engine
 * @package Flexi\Mokko
 */
class Engine extends AbstractEngine
{
    /**
     * {@inheritdoc}
     */
    public function render($template, $value)
    {
        $result = $template;

        if (!is_array($value)) {
            $value = ['' => $value];
        }

        foreach (new NestedKeyIterator(new RecursiveArrayOnlyIterator($value)) as $key => $value) {
            $result = str_replace($this->left . $key . $this->right, $value, $result);
        }

        return $result;
    }
}
