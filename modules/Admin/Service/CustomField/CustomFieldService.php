<?php
namespace Modules\Admin\Service\CustomField;

use Flexi;
use Modules;
use Modules\Admin\Model\CustomFieldGroup as CustomFieldGroupModel;
use Modules\Admin\Model\CustomField as CustomFieldModel;

/**
 * Class CustomFieldService
 * @package Modules\Admin\Service\CustomField
 */
class CustomFieldService
{
    /**
     * @param Modules\Admin\Model\Page $page
     * @return array
     */
    public function getPageFields(Modules\Admin\Model\Page $page): array
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

        if (empty($groupIds)) return $pageFields;

        $listFields = $customFieldModel->getListFieldsByGroupIds($page->id, $groupIds);

        foreach ($listFields as $field) {
            $html = Flexi\CustomField\CustomField::make($field);

            $pageFields[$field->group_id]['fields'][$field->id] = $field;
            $pageFields[$field->group_id]['fields'][$field->id]->html = $html;
        }

        return $pageFields;
    }
}
