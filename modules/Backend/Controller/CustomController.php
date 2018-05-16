<?php

namespace Modules\Backend\Controller;

use Flexi\Http\Input;

/**
 * Class CustomController
 * @package Modules\Backend\Controller
 */
class CustomController extends BackendController
{
    public function processAddGeoFields()
    {
        $params = Input::post();

        if (!empty($params)) {
            $customFieldValueModel = new \Modules\Backend\Model\CustomFieldValue();

            $customFieldValueModel->addUpdateFieldValue([
                'field_id' => 10,
                'element_id' => (int) $params['resourceId'],
                'value' => $params['lat']
            ]);

            $customFieldValueModel->addUpdateFieldValue([
                'field_id' => 11,
                'element_id' => (int) $params['resourceId'],
                'value' => $params['lng']
            ]);
        }

        exit;
    }
}
