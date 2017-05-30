<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/29/17
 * Time: 11:29 PM
 */

namespace app\index\model;


use think\Db;
use think\Model;

class ArticleModel extends Model
{

    /**
     * @return mixed
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * @param mixed $aid
     */
    public function setAid($aid)
    {
        $this->aid = $aid;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getisShow()
    {
        return $this->is_show;
    }

    /**
     * @param mixed $is_show
     */
    public function setIsShow($is_show)
    {
        $this->is_show = $is_show;
    }

    /**
     * @return mixed
     */
    public function getisDelete()
    {
        return $this->is_delete;
    }

    /**
     * @param mixed $is_delete
     */
    public function setIsDelete($is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * @return mixed
     */
    public function getisTop()
    {
        return $this->is_top;
    }

    /**
     * @param mixed $is_top
     */
    public function setIsTop($is_top)
    {
        $this->is_top = $is_top;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param mixed $cid
     */
    public function setCid($cid)
    {
        $this->cid = $cid;
    }



    private $aid;
    private $title;
    private $author;
    private $content;
    private $keywords;
    private $desc;
    private $is_show;
    private $is_delete;
    private $is_top;
    private $views;
    private $time;
    private $cid;

    public function addArticle($title, $author, $content, $keywords, $is_show = 1, $is_delete = 0, $is_top = 0, $cid = 0)
    {
        // 文章描述是文章内容的前30个字
        $desc = strlen($content) > 30 ? substr($content, 0, 30) : $desc = $content;

        $time = time();
        $result = Db::table('article')->insert([
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'keywords' => $keywords,
            'desc' => $desc,
            'is_show' => $is_show,
            'is_delete' => $is_delete,
            'is_top' => $is_top,
            'cid' => $cid,
            'time' => $time
        ]);

        // 添加文章成功返回文章的id，失败后无返回值
        if ($result == 1) {
            $aid = Db::table('article')->getLastInsID();
            return $aid;
        }
    }

    public function updateArticle($aid, $title, $author, $content, $keywords, $is_show, $is_delete, $is_top, $cid)
    {


        $result = Db::table('article')
            ->where('aid', $aid)
            ->update([$title, $author, $content, $keywords, $is_show, $is_delete, $is_top, $cid]);

        // 返回值是数据库里受影响的条数，0，就是修改失败了
        return $result;
    }

    public function deleteArticle($aid)
    {
        // 根据 primary key 直接删除
        Db::table('article')->delete($aid);
    }

    public function getArticle($aid)
    {
        // 返回查询到的数据，没有就返回null
        return Db::table('article')->where('aid', $aid)->find();
    }
}