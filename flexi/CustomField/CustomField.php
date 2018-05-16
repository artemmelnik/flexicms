<?php
namespace Flexi\CustomField;

use Flexi\CustomField\Component\InputField;
use Flexi\CustomField\Component\SelectField;
use Flexi\CustomField\Component\TextareaField;
use Flexi\CustomField\Types\TypeCustomField;

/**
 * Class CustomField
 * @package Flexi\CustomField
 */
class CustomField
{
    /**
     * @param \stdClass $field
     * @return string
     */
    public static function make(\stdClass $field): string
    {
        switch ($field->type) {
            case TypeCustomField::TYPE_TEXT:
                $createField = new InputField($field);
                break;
            case TypeCustomField::TYPE_EMAIL:
                $createField = new InputField($field);
                break;
            case TypeCustomField::TYPE_NUMBER:
                $createField = new InputField($field);
                break;
            case TypeCustomField::TYPE_TEXTAREA:
                $createField = new TextareaField($field);
                break;
            case TypeCustomField::TYPE_SELECT:
                $createField = new SelectField($field);
                break;
        }

        if (isset($createField)) {
            return $createField->buildTemplate();
        }

        return '';
    }
}
