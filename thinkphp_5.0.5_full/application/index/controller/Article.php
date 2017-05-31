<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/29/17
 * Time: 11:28 PM
 */

namespace app\index\controller;


use app\index\model\ArticleModel;
use think\Controller;
use think\Request;

class Article extends Controller
{

    private $article_model = null;

    public function __construct()
    {
        $this->article_model = new ArticleModel();
    }

    // 返回文章详情
    public function getArticle()
    {
        $request = Request::instance();

        // 获取URL地址中的PATH_INFO信息 不含后缀
        // TODO 路由的判断有问题，需要修改
        $path = $request->path();
        $path_arr = explode('/', $path);
        $aid = end($path_arr);
        return $this->articleDetailView($aid);
    }

    public function createArticle()
    {
        $request = Request::instance();
        $param = $request->param();


        $author = "大冲";
        $result = $this->article_model
            ->addArticle(
                $param['title'],
                $author,
                $param['content'],
                $param['keywords']
            );

        if ($result == null) {
            // TODO 创建文章失败的处理
            return "just fail";
        } else {
            return $this->articleDetailView($result);
        }
    }

    // 返回编辑文章的页面
    public function editArticle()
    {
        return view('edit_article');
    }

    /**
     * @param $aid
     * @return string|\think\response\View
     */
    private function articleDetailView($aid)
    {
        $article = $this->article_model->getArticle($aid);
        $article['time_h'] = date('Y-m-d H:i:s', $article['time']);
        if ($article) {
            // TODO 修改数据库，添加一次阅读量。
            return view('article', [
                'title' => $article['title'],
                'author' => $article['author'],
                'content' => $article['content'],
                'desc' => $article['desc'],
                'time_h' => $article['time_h'],
            ]);
        } else {
            return 'not find';
        }
    }

}