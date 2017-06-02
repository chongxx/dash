<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// miss 这个用来处理404也不知道是不是正确的做法？
//Route::miss('notfind/index');

// 查看文章详情
Route::get('article/:id', 'article/getarticle');
// 添加文章
Route::post('create_article', 'article/createarticle');
// 编辑文章的页面
Route::get('edit_article', 'article/editarticle');


Route::get('/', 'Home/home');

// 登录注册的页面
Route::get('login', 'UserSystem/viewLogin');
// 登录接口
Route::post('session', 'UserSystem/login');
// 注册接口
Route::post('register', 'UserSystem/register');
// 重置密码
Route::post('reset_pwd', 'UserSystem/resetPassword');


return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 静态配置路由
    '[article]' => [
        ':aid' => ['article/']
    ]
];
