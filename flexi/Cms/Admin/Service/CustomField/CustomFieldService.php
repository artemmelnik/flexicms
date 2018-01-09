<?php
namespace Flexi\Cms\Admin\Service\CustomField;

use Flexi;
use Flexi\Cms\Admin\Model\CustomFieldGroup as CustomFieldGroupModel;
use Flexi\Cms\Admin\Model\CustomField as CustomFieldModel;

/**
 * Class CustomFieldService
 * @package Flexi\Cms\Admin\Service\CustomField
 */
class CustomFieldService
{
    /**
     * @param Flexi\Cms\Admin\Model\Page $page
     * @return array
     */
    public function getPageFields(Flexi\Cms\Admin\Model\Page $page): array
    {
        $pageFields = [];
        $groupIds = [];

        $customFieldGroupModel = new CustomFieldGroupModel();
        $customFieldModel = new CustomFieldModel();

        $listGroup = $customFieldGroupModel->getFieldGroupByPage($page);

        foreach ($listGroup as $group) {
            $pageFields[$group->id]['group'] = $group;
            $groupIds[] = $group->id;
        }

        $listFields = $customFieldModel->getListFieldsByGroupIds($page->id, $groupIds);

        foreach ($listFields as $field) {
            $html = Flexi\CustomField\CustomField::make($field);

            $pageFields[$field->group_id]['fields'][$field->id] = $field;
            $pageFields[$field->group_id]['fields'][$field->id]->html = $html;
        }

        return $pageFields;
    }
}
