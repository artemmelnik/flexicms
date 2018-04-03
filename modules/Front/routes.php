<?php

Route::get('/', [
    'controller' => 'HomeController',
    'action'     => 'index'
]);

Route::get('/(resourceType:any)/show/(segment:any)', [
    'controller' => 'ResourceController',
    'action'     => 'show'
]);