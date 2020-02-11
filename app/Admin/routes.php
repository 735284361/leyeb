<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('vip-companies', CompanyController::class);
    $router->resource('vip-company-users', CompanyUserController::class);
    $router->resource('vip-company-courses', CompanyCourseController::class);
    $router->resource('vip-company-tokens', CompanyTokenController::class);


    // 代理商
    $router->get('admin-user/users','Api\AdminUserController@users')->name('admin-user/users');
    $router->get('user/users','Api\UsersController@users')->name('user/users');
    $router->get('company/invite-token','Api\CompanyTokenController@inviteToken')->name('admin.company.invite-token');
    $router->get('justice/list','Api\JusticeController@lists')->name('admin.justice.list');
});
