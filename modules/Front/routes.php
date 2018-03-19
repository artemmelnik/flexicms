<?php

Route::get('/', [
    'controller' => 'HomeController',
    'action'     => 'index'
]);

Route::get('/r/(resourceType:any)/(segment:any)', [
    'controller' => 'ResourceController',
    'action'     => 'show'
]);