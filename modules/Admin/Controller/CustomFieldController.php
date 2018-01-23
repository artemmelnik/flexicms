<?php
namespace Modules\Admin\Controller;

use \View;
use Flexi;
use Modules;

/**
 * Class CustomFieldController
 * @package Modules\Admin\Controller
 */
class CustomFieldController extends AdminController
{
    /**
     * @var Modules\Admin\Model\CustomFieldGroup
     */
    protected $customFieldGroupModel;

    /**
     * @var Modules\Admin\Model\CustomField
     */
    protected $customFieldModel;

    /**
     * CustomFieldController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->customFieldGroupModel = new Modules\Admin\Model\CustomFieldGroup();
        $this->customFieldModel = new Modules\Admin\Model\CustomField();
    }

    /**
     * @return \Flexi\Template\View
     */
    public function listingGroup()
    {
        return View::make('custom_fields/list_group', [
            'groupFieldTypes' => Flexi\CustomField\Types\TypeGroup::ARRAY_GROUP_TYPES,
            'listLayouts' => getLayouts(),
            'listTemplates' => getTypes(),
            'listGroup' => $this->customFieldGroupModel->getListGroup()
        ]);
    }

    public function showGroup(int $id)
    {
        $group = $this->customFieldGroupModel->getGroupById($id);

        if (!$group) {
            exit('404');
        }

        $fieldList = $this->customFieldModel->getListFieldsByGroupId($group->id);

        return View::make('custom_fields/fields_group', [
            'group' => $group,
            'fieldList' => $fieldList
        ]);
    }

    /**
     * Load options by type entity
     */
    public function loadTemplatesByType()
    {
        $params = Flexi\Http\Input::post();

        if (isset($params['type'])) {
            echo \Component::get('custom_fields/components/template_options', [
                'listTemplates' => getTypes($params['type'])
            ]);
        }

        exit;
    }

    public function loadNewFieldTemplate()
    {
        $params = Flexi\Http\Input::post();

        if (isset($params['group_id'])) {
            echo \Component::get('custom_fields/components/item_field', [
                'groupId' => $params['group_id']
            ]);
        }

        exit;
    }

    /**
     * Add field group
     */
    public function addGroup()
    {
        $params = Flexi\Http\Input::post();

        $customFieldGroupId = $this->customFieldGroupModel->addGroup([
            'title'    => $params['title'],
            'type'     => $params['type'],
            'layout'   => $params['layout'],
            'template' => $params['template']
        ]);

        echo $customFieldGroupId;
        exit;
    }

    public function updateFields()
    {
        $params = Flexi\Http\Input::post();
        $result = [];

        if (empty($params)) exit;

        foreach ($params['fields'] as $id => $field) {
            $field['group_id'] = $params['group_id'];
            $field['required'] = isset($field['required']) ? 1 : 0;
            $field['status'] = 1;

            $fieldParams = new Flexi\CustomField\Params\CustomFieldParams($field);

            if (strlen($fieldParams->getLabel()) < 2) {
                $result['errors'][$id]['label'] = 'error';
            }

            if (strlen($fieldParams->getName()) < 2) {
                $result['errors'][$id]['name'] = 'error';
            }

            if (strlen($fieldParams->getType()) < 2) {
                $result['errors'][$id]['type'] = 'error';
            }

            if (isset($result['errors'])) continue;

            if (is_int($id)) {
                $this->customFieldModel->updateField($id, $fieldParams);
            } else {
                $this->customFieldModel->addField($fieldParams);
            }
        }

        echo json_encode($result);
        exit;
    }
}
