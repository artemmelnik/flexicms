<?php

Route::get('/backend/login/', [
    'controller' => 'LoginController',
    'action'     => 'form'
]);

Route::get('/backend/', [
    'controller' => 'BackendController',
    'action'     => 'dashboard'
]);

Route::get('/backend/logout/', [
    'controller' => 'BackendController',
    'action'     => 'logout'
]);

Route::post('/backend/auth/', [
    'controller' => 'LoginController',
    'action'     => 'auth'
]);

Route::get('/backend/pages/', [
    'controller' => 'PageController',
    'action'     => 'listing'
]);

Route::get('/backend/pages/create/', [
    'controller' => 'PageController',
    'action'     => 'create'
]);

Route::get('/backend/pages/edit/(id:numeric)', [
    'controller' => 'PageController',
    'action'     => 'edit'
]);

Route::post('/backend/page/add/', [
    'controller' => 'PageController',
    'action'     => 'add'
]);

Route::post('/backend/page/update/', [
    'controller' => 'PageController',
    'action'     => 'update'
]);

Route::get('/backend/posts/', [
    'controller' => 'PostController',
    'action'     => 'listing'
]);

Route::get('/backend/posts/create/', [
    'controller' => 'PostController',
    'action'     => 'create'
]);

Route::get('/backend/posts/edit/(id:numeric)', [
    'controller' => 'PostController',
    'action'     => 'edit'
]);

Route::post('/backend/post/add/', [
    'controller' => 'PostController',
    'action'     => 'add'
]);

Route::post('/backend/post/update/', [
    'controller' => 'PostController',
    'action'     => 'update'
]);

Route::get('/backend/resources/(name:any)', [
    'controller' => 'ResourceController',
    'action'     => 'listing'
]);

Route::get('/backend/resource/(name:any)/create/', [
    'controller' => 'ResourceController',
    'action'     => 'create'
]);

Route::get('/backend/resource/(name:any)/edit/(id:numeric)', [
    'controller' => 'ResourceController',
    'action'     => 'edit'
]);

Route::post('/backend/resource/add/', [
    'controller' => 'ResourceController',
    'action'     => 'add'
]);

Route::post('/backend/resource/update/', [
    'controller' => 'ResourceController',
    'action'     => 'update'
]);

Route::get('/backend/settings/general/', [
    'controller' => 'SettingController',
    'action'     => 'general'
]);

Route::get('/backend/settings/appearance/menus/', [
    'controller' => 'SettingController',
    'action'     => 'menus'
]);

Route::get('/backend/settings/appearance/themes/', [
    'controller' => 'SettingController',
    'action'     => 'themes'
]);

Route::post('/backend/settings/update/', [
    'controller' => 'SettingController',
    'action'     => 'updateSetting'
]);

Route::post('/backend/settings/ajaxMenuAdd/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuAdd'
]);

Route::post('/backend/settings/ajaxMenuAddItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxAddMenuItem'
]);

Route::post('/backend/settings/ajaxMenuSortItems/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuSortItems'
]);

Route::post('/backend/settings/ajaxMenuRemoveItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuRemoveItem'
]);

Route::post('/backend/settings/ajaxMenuUpdateItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuUpdateItem'
]);

Route::post('/backend/settings/activateTheme/', [
    'controller' => 'SettingController',
    'action'     => 'activateTheme'
]);

Route::get('/backend/plugins/', [
    'controller' => 'PluginController',
    'action'     => 'listPlugins'
]);

Route::post('/backend/plugins/ajaxInstall/', [
    'controller' => 'PluginController',
    'action'     => 'ajaxInstall'
]);

Route::post('/backend/plugins/ajaxActivate/', [
    'controller' => 'PluginController',
    'action'     => 'ajaxActivate'
]);

Route::get('/backend/settings/custom_fields/', [
    'controller' => 'CustomFieldController',
    'action'     => 'listingGroup'
]);

Route::get('/backend/settings/custom_fields/group/(id:numeric)', [
    'controller' => 'CustomFieldController',
    'action'     => 'showGroup'
]);

Route::post('/backend/custom_fields/ajaxLoadTemplates/', [
    'controller' => 'CustomFieldController',
    'action'     => 'loadTemplatesByType'
]);

Route::post('/backend/custom_fields/ajaxLoadNewFieldTemplate/', [
    'controller' => 'CustomFieldController',
    'action'     => 'loadNewFieldTemplate'
]);

Route::post('/backend/custom_fields/ajaxAddGroup/', [
    'controller' => 'CustomFieldController',
    'action'     => 'addGroup'
]);

Route::post('/backend/custom_fields/ajaxUpdateFields/', [
    'controller' => 'CustomFieldController',
    'action'     => 'updateFields'
]);

Route::get('/backend/resource/(resourceTypeId:numeric)/category/create/', [
    'controller' => 'CategoryController',
    'action'     => 'create'
]);

Route::get('/backend/resource/(resourceTypeId:numeric)/category/edit/(resourceId:numeric)', [
    'controller' => 'CategoryController',
    'action'     => 'edit'
]);

Route::post('/backend/category/create/', [
    'controller' => 'CategoryController',
    'action'     => 'processCreateCategory'
]);
