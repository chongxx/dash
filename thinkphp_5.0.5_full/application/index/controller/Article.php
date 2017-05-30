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
        $path = $request->path();
        $path_arr = explode('/', $path);
        $aid = end($path_arr);
        $article = $this->article_model->getArticle($aid);

        $article['time_h'] = date('Y-m-d H:i:s', $article['time']);
        if ($article) {
            // 添加一次阅读量

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
            return json(['ok' => 0]);
        } else {
            return json(['ok' => 1, 'aid' => $result]);
        }
    }

    // 返回编辑文章的页面
    public function editArticle()
    {
        return view('edit_article');
    }

}