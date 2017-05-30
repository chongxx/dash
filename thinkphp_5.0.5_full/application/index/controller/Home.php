<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/30/17
 * Time: 12:01 PM
 */

namespace app\index\controller;


use app\index\model\HomeModel;

class Home
{

    // 返回首页视图
    public function home()
    {
        $home_model = new HomeModel();
        $articles = $home_model->getArticleList();
        return view('index', ['articles' => $articles]);
    }
}