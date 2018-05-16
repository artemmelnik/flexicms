<?php

namespace Flexi\CustomField\Component;

use Flexi;
use Flexi\CustomField;
use stdClass;

/**
 * Class SelectField
 * @package Flexi\CustomField\Component
 */
class SelectField extends CustomField\AbstractField
{
    /**
     * SelectField constructor.
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
        $data = $this->dataToArray();
        $extraData = json_decode($data['extra_data'], true);

        $optionHtml = '';

        if (isset($extraData['options'])) {
            foreach ($extraData['options'] as $option) {
                $selected = '';

                if ($option['value'] == $data['value']) {
                    $selected = ' selected';
                }

                $optionHtml .= '<option value="' . $option['value'] . '"' . $selected . '>' . $option['text'] . '</option>';
            }
        }

        $template = '<div class="field">
            <label>' . $data['label'] . '</label>
            <p>' . $data['description'] . '</p>
            <select class="ui fluid dropdown" name="fields[' . $data['id'] . ']" id="field_' . $data['id'] . '">' . $optionHtml . '</select>
        </div>';

        return $template;
    }
}
