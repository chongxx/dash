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


//Route::rule('news', 'news/index');

// miss 这个用来处理404也不知道是不是正确的做法？
//Route::miss('notfind/index');

Route::get('news', 'news/read');
//Route::post('user', 'user/create');

// user route
Route::get('users', 'user/getall');
Route::post('create_user', 'user/create');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 静态配置路由
    // 'news' => ['news/index', ['method' => 'post|get|put']],
];
