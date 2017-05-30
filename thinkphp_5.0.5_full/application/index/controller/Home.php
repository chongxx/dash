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

//        $articles[0]->timeH = "time_h";

        return $articles[0];
//        return var_dump($articles[0]);
//        return view('index', ['articles' => $articles]);
    }
}