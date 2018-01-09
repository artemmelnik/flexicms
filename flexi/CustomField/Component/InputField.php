<?php
namespace Flexi\CustomField\Component;

use Flexi;
use Flexi\CustomField;
use stdClass;

/**
 * Class TextField
 * @package Flexi\CustomField\Component
 */
class InputField extends CustomField\AbstractField
{
    /**
     * TextField constructor.
     * @param stdClass $field
     */
    public function __construct(stdClass $field)
    {
        parent::__construct((array) $field);
    }

    /**
     * @return string
     */
    public function buildTemplate(): string
    {
        $mokko = new Flexi\Mokko\Engine();

        $template = '<div class="field">
            <label>{{label}}</label>
            <input type="{{type}}" name="fields[{{id}}]" id="field_{{id}}" value="{{value}}">
        </div>';

        return $mokko->render($template, $this->dataToArray());
    }
}
