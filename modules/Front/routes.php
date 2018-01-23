<?php

Route::get('/', [
    'controller' => 'HomeController',
    'action'     => 'index'
]);

Route::get('/page/(segment:any)', [
    'controller' => 'PageController',
    'action'     => 'show'
]);