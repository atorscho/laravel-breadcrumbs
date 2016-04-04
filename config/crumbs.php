<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Crumbs View
    |--------------------------------------------------------------------------
    |
    | You can select which breadcrumb template you want to use.
    | You may also use your own view.
    |
    | The "-md" variant includes a MicroData structure.
    |
    | Default: crumbs::semanticui
    |
    | Views: bootstrap3(-md), foundation-nav(-md),
    |        foundation-ul(-md), semanticui(-md)
    |
    */

    'crumbs_view' => 'crumbs::semanticui',

    /*
    |--------------------------------------------------------------------------
    | Current Crumb Item Class
    |--------------------------------------------------------------------------
    |
    | If you need to change the class name of current breadcrumb item.
    |
    */

    'current_item_class' => 'active',

    /*
    |--------------------------------------------------------------------------
    | Disabled Class
    |--------------------------------------------------------------------------
    |
    | If you want to mark an item as disabled (when its URL is '#'),
    | you may specify its class name here.
    |
    */

    'disabled_item_class' => 'disabled',

    /*
    |--------------------------------------------------------------------------
    | Default Pages
    |--------------------------------------------------------------------------
    |
    | Home and Admin pages settings.
    |
    | Titles support HTML tags.
    |
    | Admin URL may be a relative URL or a route name.
    |
    | Admin pattern is used to show its breadcrumb only when needed.
    |
    */

    'home_title'    => 'Home',
    'home_url'      => 'home',
    'admin_title'   => 'Admin',
    'admin_url'     => 'admin.index',
    'admin_pattern' => '*admin*',

    /*
    |--------------------------------------------------------------------------
    | Display Default Crumbs Items
    |--------------------------------------------------------------------------
    |
    | You can choose if you want to always show home section, admin section,
    | or both.
    |
    | Examples:
    | If `display_home_page` == true: 'Home' > 'Main Section' > 'Sub Section'.
    | If `display_admin_page` == true: 'Admin' > 'Main Section' > 'Sub Section'.
    | If `display_both_pages` == true: 'Home' > 'Admin' > 'Main Section' > 'Sub Section'.
    |
    | Specify the `admin_Pattern` to display its item only when appropriate.
    |
    */

    'display_home_page'  => true,
    'display_admin_page' => true,
    'display_both_pages' => false,

    /*
    |--------------------------------------------------------------------------
    | Page Title Separator
    |--------------------------------------------------------------------------
    |
    | Crumbs includes a feature for displaying page titles.
    | Here you may define its separator.
    |
    */

    'page_title_separator' => ' &raquo; '

];
