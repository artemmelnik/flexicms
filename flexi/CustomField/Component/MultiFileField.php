<?php

namespace Flexi\CustomField\Component;

use Flexi;
use Flexi\CustomField;
use stdClass;

/**
 * Class MultiFileField
 * @package Flexi\CustomField\Component
 */
class MultiFileField extends CustomField\AbstractField
{
    /**
     * MultiFileField constructor.
     * @param stdClass $field
     */
    public function __construct(stdClass $field)
    {
        parent::__construct((array) $field);
    }

    /**
     * @return string
     */
    public function buildTemplate()
    {
        $data = $this->dataToArray();

        $template = '<div class="field">
            <label>' . $data['label'] . '</label>
            <p>' . $data['description'] . '</p>
            <input type="file" name="fields[' . $data['id'] . ']" id="field_' . $data['id'] . '" class="js-custom-field-file" data-id="' . $data['id'] . '" multiple>
            <input type="hidden" name="fields[' . $data['id'] . ']" id="post_field_' . $data['id'] . '" value="' . $data['value'] . '">
        </div>';

        return $template;
    }
}
