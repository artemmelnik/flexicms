<?php
namespace Modules\Backend\Controller;

use Flexi\Localization\I18n;
use \View;
use Flexi;
use Modules;
use Modules\Backend\Model\ResourceType as ResourceTypeModel;

/**
 * Class CustomFieldController
 * @package Modules\Backend\Controller
 */
class CustomFieldController extends BackendController
{
    /**
     * @var Modules\Backend\Model\CustomFieldGroup
     */
    protected $customFieldGroupModel;

    /**
     * @var Modules\Backend\Model\CustomField
     */
    protected $customFieldModel;

    /**
     * CustomFieldController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setData('settingNavItems', \Customize::instance()->getAdminSettingItems());

        $this->customFieldGroupModel = new Modules\Backend\Model\CustomFieldGroup();
        $this->customFieldModel = new Modules\Backend\Model\CustomField();
    }

    /**
     * @return \Flexi\Template\View
     */
    public function listingGroup()
    {
        I18n::instance()
            ->load('custom_fields/list_group');

        $resourceTypeModel = new ResourceTypeModel();

        //$this->setData('groupFieldTypes', Flexi\CustomField\Types\TypeGroup::ARRAY_GROUP_TYPES);
        $this->setData('groupFieldTypes', $resourceTypeModel->getResourcesType());
        $this->setData('listTemplates', getTypes());
        $this->setData('listGroup', $this->customFieldGroupModel->getListGroup());

        return View::make('custom_fields/list_group', $this->data);
    }

    public function showGroup(int $id)
    {
        $group = $this->customFieldGroupModel->getGroupById($id);

        if (!$group) {
            exit('404');
        }

        $fieldList = $this->customFieldModel->getListFieldsByGroupId($group->id);

        $this->setData('group', $group);
        $this->setData('fieldList', $fieldList);
        $this->setData('fieldTypes', Flexi\CustomField\Types\TypeCustomField::ARRAY_FIELD_TYPES);

        return View::make('custom_fields/fields_group', $this->data);
    }

    /**
     * Load options by type entity
     */
    public function loadTemplatesByType()
    {
        $params = Flexi\Http\Input::post();

        if (isset($params['type'])) {
            echo \View::make('custom_fields/components/template_options', [
                'listTemplates' => getTypes($params['type'])
            ])->render();
        }

        exit;
    }

    public function loadNewFieldTemplate()
    {
        $params = Flexi\Http\Input::post();

        if (isset($params['group_id'])) {
            echo \View::make('custom_fields/components/item_field', [
                'groupId' => $params['group_id'],
                'fieldTypes' => Flexi\CustomField\Types\TypeCustomField::ARRAY_FIELD_TYPES
            ])->render();
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
            //'layout'   => $params['layout'],
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
