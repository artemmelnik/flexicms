<?php
/**
 * List of routes in the Admin environment
 */

$this->router->add('login', '/admin/login/', 'LoginController:form');
$this->router->add('auth-admin', '/admin/auth/', 'LoginController:authAdmin', 'POST');
$this->router->add('dashboard', '/admin/', 'DashboardController:index');
$this->router->add('logout', '/admin/logout/', 'AdminController:logout');

// Pages Routes (GET)
$this->router->add('pages', '/admin/pages/', 'PageController:listing');
$this->router->add('page-create', '/admin/pages/create/', 'PageController:create');
$this->router->add('page-edit', '/admin/pages/edit/(id:int)', 'PageController:edit');
// Pages Routes (POST)
$this->router->add('page-add', '/admin/page/add/', 'PageController:add', 'POST');
$this->router->add('page-update', '/admin/page/update/', 'PageController:update', 'POST');

// Posts Routes (GET)
$this->router->add('posts', '/admin/posts/', 'PostController:listing');
$this->router->add('post-create', '/admin/posts/create/', 'PostController:create');
$this->router->add('post-edit', '/admin/posts/edit/(id:int)', 'PostController:edit');
// Posts Routes (POST)
$this->router->add('post-add', '/admin/post/add/', 'PostController:add', 'POST');
$this->router->add('post-update', '/admin/post/update/', 'PostController:update', 'POST');

// Settings Routes (GET)
$this->router->add('settings-general', '/admin/settings/general/', 'SettingController:general');
$this->router->add('settings-menus', '/admin/settings/appearance/menus/', 'SettingController:menus');
$this->router->add('settings-themes', '/admin/settings/appearance/themes/', 'SettingController:themes');
// Settings Routes (POST)
$this->router->add('setting-update', '/admin/settings/update/', 'SettingController:updateSetting', 'POST');
$this->router->add('setting-add-menu', '/admin/setting/ajaxMenuAdd/', 'SettingController:ajaxMenuAdd', 'POST');
$this->router->add('setting-add-menu-item', '/admin/setting/ajaxMenuAddItem/', 'SettingController:ajaxMenuAddItem', 'POST');
$this->router->add('setting-sort-menu-item', '/admin/setting/ajaxMenuSortItems/', 'SettingController:ajaxMenuSortItems', 'POST');
$this->router->add('setting-remove-menu-item', '/admin/setting/ajaxMenuRemoveItem/', 'SettingController:ajaxMenuRemoveItem', 'POST');
$this->router->add('setting-update-menu-item', '/admin/setting/ajaxMenuUpdateItem/', 'SettingController:ajaxMenuUpdateItem', 'POST');
$this->router->add('setting-update-theme', '/admin/setting/activateTheme/', 'SettingController:activateTheme', 'POST');

// Plugins Routes (GET)
$this->router->add('list-plugins', '/admin/plugins/', 'PluginController:listPlugins');
// Plugins Routes (POST)
$this->router->add('install-plugin', '/admin/plugins/ajaxInstall/', 'PluginController:ajaxInstall', 'POST');
$this->router->add('activate-plugin', '/admin/plugins/ajaxActivate/', 'PluginController:ajaxActivate', 'POST');
