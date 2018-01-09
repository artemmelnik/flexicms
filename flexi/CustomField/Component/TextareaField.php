<?php
namespace Flexi\CustomField\Component;

use Flexi;
use Flexi\CustomField;
use stdClass;

class TextareaField extends CustomField\AbstractField
{
    /**
     * TextareaField constructor.
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
            <textarea name="fields[{{id}}]" id="field_{{id}}">{{value}}</textarea>
        </div>';

        return $mokko->render($template, $this->dataToArray());
    }
}
