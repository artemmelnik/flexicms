<?php

Route::get('/admin/login/', [
    'controller' => 'LoginController',
    'action'     => 'form'
]);

Route::get('/admin/', [
    'controller' => 'AdminController',
    'action'     => 'dashboard'
]);

Route::get('/admin/logout/', [
    'controller' => 'AdminController',
    'action'     => 'logout'
]);

Route::post('/admin/auth/', [
    'controller' => 'LoginController',
    'action'     => 'authAdmin'
]);

Route::get('/admin/pages/', [
    'controller' => 'PageController',
    'action'     => 'listing'
]);

Route::get('/admin/pages/create/', [
    'controller' => 'PageController',
    'action'     => 'create'
]);

Route::get('/admin/pages/edit/(id:numeric)', [
    'controller' => 'PageController',
    'action'     => 'edit'
]);

Route::post('/admin/page/add/', [
    'controller' => 'PageController',
    'action'     => 'add'
]);

Route::post('/admin/page/update/', [
    'controller' => 'PageController',
    'action'     => 'update'
]);

Route::get('/admin/posts/', [
    'controller' => 'PostController',
    'action'     => 'listing'
]);

Route::get('/admin/posts/create/', [
    'controller' => 'PostController',
    'action'     => 'create'
]);

Route::get('/admin/posts/edit/(id:numeric)', [
    'controller' => 'PostController',
    'action'     => 'edit'
]);

Route::post('/admin/post/add/', [
    'controller' => 'PostController',
    'action'     => 'add'
]);

Route::post('/admin/post/update/', [
    'controller' => 'PostController',
    'action'     => 'update'
]);

Route::get('/admin/settings/general/', [
    'controller' => 'SettingController',
    'action'     => 'general'
]);

Route::get('/admin/settings/appearance/menus/', [
    'controller' => 'SettingController',
    'action'     => 'menus'
]);

Route::get('/admin/settings/appearance/themes/', [
    'controller' => 'SettingController',
    'action'     => 'themes'
]);

Route::post('/admin/settings/update/', [
    'controller' => 'SettingController',
    'action'     => 'updateSetting'
]);

Route::post('/admin/settings/ajaxMenuAdd/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuAdd'
]);

Route::post('/admin/settings/ajaxMenuAddItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxAddMenuItem'
]);

Route::post('/admin/settings/ajaxMenuSortItems/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuSortItems'
]);

Route::post('/admin/settings/ajaxMenuRemoveItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuRemoveItem'
]);

Route::post('/admin/settings/ajaxMenuUpdateItem/', [
    'controller' => 'SettingController',
    'action'     => 'ajaxMenuUpdateItem'
]);

Route::post('/admin/settings/activateTheme/', [
    'controller' => 'SettingController',
    'action'     => 'activateTheme'
]);

Route::get('/admin/plugins/', [
    'controller' => 'PluginController',
    'action'     => 'listPlugins'
]);

Route::post('/admin/plugins/ajaxInstall/', [
    'controller' => 'PluginController',
    'action'     => 'ajaxInstall'
]);

Route::post('/admin/plugins/ajaxActivate/', [
    'controller' => 'PluginController',
    'action'     => 'ajaxActivate'
]);
