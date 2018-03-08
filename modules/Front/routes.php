<?php

Route::get('/', [
    'controller' => 'HomeController',
    'action'     => 'index'
]);

Route::get('/(resourceType:any)/(segment:any)', [
    'controller' => 'ResourceController',
    'action'     => 'show'
]);