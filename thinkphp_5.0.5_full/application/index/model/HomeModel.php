<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/30/17
 * Time: 12:07 PM
 */

namespace app\index\model;


use think\Db;
use think\Model;

class HomeModel extends Model
{
    public function getArticleList()
    {
        // 在数据库查询最新的10篇文章
        $articles = Db::table('article')
            ->page(1, 10)
            ->select();
        new ArticleModel($articles);
        return $articles;
    }
}