<?php

return [

    [
        'icon' => 'mdi mdi-home',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard',
    ],

    [
        'icon' => 'mdi mdi-view-list',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*',

    ],

    [
        'icon' => 'mdi mdi-shopping',
        'route' => 'dashboard.categories.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
    ],


];
