<?php

Route::get('/', [
    'controller' => 'HomeController',
    'action'     => 'index'
]);

$resourceModel = new \Modules\Backend\Model\ResourceType();
$resourceTypes = $resourceModel->getResourcesType();

foreach ($resourceTypes as $resourceType) {
    Route::get('/' . $resourceType->name . '/(segment:any)', [
        'controller' => 'ResourceController',
        'action'     => 'show'
    ]);
}
