<?php

Route::post('login', 'Admin\AuthController@login')->name('login');

Route::group(['middleware'=>'admin'], function () {
//    Route::group(['middleware'=>['jwt.role:admin', 'jwt.auth']], function () {
    Route::group(['prefix'=>'auth'], function ($router) {
        Route::post('logout', ['uses'=>'Admin\AuthController@logout','permission'=>'logout']);
        Route::get('info', 'Admin\AuthController@info');
        Route::post('getRouters', 'Admin\AuthController@getRouters');
    });
    Route::group(['prefix'=>'user'], function ($router) {
        Route::get('index', ['uses'=>'Admin\UserController@index']);
        Route::get('loadedit', ['uses'=>'Admin\UserController@loadEdit']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\UserController@status','permission'=>'user:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\UserController@edit','permission'=>'user:edit']);
        Route::post('create', ['uses'=>'Admin\UserController@create','permission'=>'user:create']);
        Route::put('update/{id}', ['uses'=>'Admin\UserController@update','permission'=>'user:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\UserController@delete','permission'=>'user:delete']);
    });

    Route::group(['prefix'=>'role'], function ($router) {
        Route::get('index', ['uses'=>'Admin\RoleController@index']);
        Route::get('permission/{id}', ['uses'=>'Admin\RoleController@permission','permission'=>'role:permission']);
        Route::put('savePermission/{id}', ['uses'=>'Admin\RoleController@savePermission','permission'=>'role:permission']);

        Route::post('create', ['uses'=>'Admin\RoleController@create','permission'=>'role:create']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\RoleController@status','permission'=>'role:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\RoleController@edit','permission'=>'role:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\RoleController@update','permission'=>'role:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\RoleController@delete','permission'=>'role:delete']);
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('index', ['uses'=>'Admin\MenuController@index']);
        Route::get('loadedit', ['uses'=>'Admin\MenuController@loadEdit']);
        Route::post('create', ['uses'=>'Admin\MenuController@create','permission'=>'menu:create']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\MenuController@status','permission'=>'menu:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\MenuController@edit','permission'=>'menu:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\MenuController@update','permission'=>'menu:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\MenuController@delete','permission'=>'menu:delete']);
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('index', ['uses'=>'Admin\SettingsController@index']);
        Route::post('create', ['uses'=>'Admin\SettingsController@create','permission'=>'settings:create']);
        Route::get('edit/{id}', ['uses'=>'Admin\SettingsController@edit','permission'=>'settings:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\SettingsController@update','permission'=>'settings:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\SettingsController@delete','permission'=>'settings:delete']);
    });
    Route::get('actionlog', ['uses'=>'Admin\ActionLogController@index','permission'=>'actionlog']);

    Route::group(['prefix' => 'region'], function () {
        Route::get('lists/{code}/{type}', ['uses'=>'Admin\RegionPickerController@lists']);
        Route::get('loadProvince', ['uses'=>'Admin\RegionPickerController@loadProvince']);
    });
    Route::group(['prefix' => 'general'], function () {
        Route::post('code', ['uses'=>'Admin\GeneralController@code','permission'=>'code']);
    });
    Route::group(['prefix' => 'crontab'], function () {
        Route::get('index', ['uses'=>'Admin\CrontabController@index']);
        Route::post('create', ['uses'=>'Admin\CrontabController@create','permission'=>'crontab:create']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\CrontabController@status','permission'=>'crontab:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\CrontabController@edit','permission'=>'crontab:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\CrontabController@update','permission'=>'crontab:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\CrontabController@delete','permission'=>'crontab:delete']);
    });
    Route::group(['prefix'=>'member'], function ($router) {
        Route::get('index', ['uses'=>'Admin\MemberController@index','permission'=>'member']);
        Route::post('create', ['uses'=>'Admin\MemberController@create','permission'=>'member:create']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\MemberController@status','permission'=>'member:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\MemberController@edit','permission'=>'member:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\MemberController@update','permission'=>'member:update']);
    });
    Route::group(['prefix'=>'memberLevel'], function ($router) {
        Route::get('index', ['uses'=>'Admin\MemberLevelController@index','permission'=>'memberLevel']);
        Route::post('create', ['uses'=>'Admin\MemberLevelController@create','permission'=>'memberLevel:create']);
        Route::put('status/{id}/{status}', ['uses'=>'Admin\MemberLevelController@status','permission'=>'memberLevel:status']);
        Route::get('edit/{id}', ['uses'=>'Admin\MemberLevelController@edit','permission'=>'memberLevel:edit']);
        Route::put('update/{id}', ['uses'=>'Admin\MemberLevelController@update','permission'=>'memberLevel:update']);
        Route::delete('delete/{id}', ['uses'=>'Admin\MemberLevelController@delete','permission'=>'memberLevel:delete']);
    });
    Route::group(['prefix'=>'files'], function ($router) {
        Route::get('index', ['uses'=>'Admin\FilesController@index']);
        Route::match(['get', 'post'], 'chunk',['uses'=>'Admin\FilesController@chunk']);
        Route::post('merge', ['uses'=>'Admin\FilesController@merge']);
        Route::delete('delete/{id}', ['uses'=>'Admin\FilesController@delete']);
    });
    Route::group(['prefix'=>'attachment'], function ($router) {
        Route::get('load', ['uses'=>'Admin\AttachmentController@load','permission'=>'attachment']);
        Route::put('update', ['uses'=>'Admin\AttachmentController@update','permission'=>'attachment']);
    });
    Route::group(['prefix'=>'weixin','permission'=>'weixin'], function ($router) {
        Route::get('load/{name}', ['uses'=>'Admin\WeixinController@load']);
        Route::put('wechat', ['uses'=>'Admin\WeixinController@wechat','permission'=>'weixin:wechat']);
        Route::put('wxapp', ['uses'=>'Admin\WeixinController@wxapp','permission'=>'weixin:wxapp']);
        Route::put('pay', ['uses'=>'Admin\WeixinController@pay','permission'=>'weixin:pay']);
    });
});
