<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Crumbs View
    |--------------------------------------------------------------------------
    |
    | You can select which configuration you want to use.
    | Choose between `crumbs::crumbs-bootstrap3` and `crumbs::crumbs-semanticui`.
    | You may also use your own view.
    |
    | Default: crumbs::crumbs-bootstrap3
    |
    */
    'crumbsView'       => 'crumbs::crumbs-semanticui',
    /*
    |--------------------------------------------------------------------------
    | Current Crumb Item Class
    |--------------------------------------------------------------------------
    |
    | If you need to change the class name of current breadcrumb item.
    |
    */
    'currentItemClass' => 'active',
    /*
    |--------------------------------------------------------------------------
    | Default Pages
    |--------------------------------------------------------------------------
    |
    | Home and Admin pages settings.
    |
    | Titles support HTML tags.
    |
    | Admin pattern is used to show its breadcrumb only when needed.
    |
    */
    'homeTitle'        => '{labels.home}',
    'homeUrl'          => 'home',
    'adminTitle'       => '{labels.admin}',
    'adminUrl'         => 'admin.index',
    'adminPattern'     => 'admin*',
    /*
    |--------------------------------------------------------------------------
    | Display Default Crumbs Items
    |--------------------------------------------------------------------------
    |
    | You can choose if you want to always show home section, admin section,
    | or both.
    |
    | Examples:
    | If `displayHomePage` == true: 'Home' > 'Main Section' > 'Sub Section'.
    | If `displayAdminPage` == true: 'Admin' > 'Main Section' > 'Sub Section'.
    | If `displayBothPages` == true: 'Home' > 'Admin' > 'Main Section' > 'Sub Section'.
    |
    | Specify the `adminPattern` to display its item only when appropriate.
    |
    */
    'displayHomePage'  => true,
    'displayAdminPage' => true,
    'displayBothPages' => false,

];
