<?php
namespace Flexi\Mokko;

/**
 * Class SprintfEngine
 * @package Flexi\Mokko
 */
class SprintfEngine extends Engine
{
    /**
     * {@inheritdoc}
     */
    public function render($template, $value)
    {
        //Performance: if there are no '%' fallback to Engine
        if (strstr($template, '%') == false) {
            return parent::render($template, $value);
        }

        $result = $template;
        if (!is_array($value)) {
            $value = ['' => $value];
        }

        foreach (new NestedKeyIterator(new RecursiveArrayOnlyIterator($value)) as $key => $value) {
            $pattern = "/" . $this->left . $key . "(%[^" . $this->right . "]+)?" . $this->right . "/";
            preg_match_all($pattern, $template, $matches);

            $substs = array_map(function ($match) use ($value) {
                return $match !== '' ? sprintf($match, $value) : $value;
            }, $matches[1]);

            $result = str_replace($matches[0], $substs, $result);
        }

        return $result;
    }
}
