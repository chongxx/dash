<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 6/2/17
 * Time: 11:28 PM
 */

namespace app\index\controller;

// 负责用户的注册和登录
use app\index\model\UserSystemModel;
use think\Controller;
use think\Cookie;
use think\Request;

class UserSystem extends Controller
{
    // 返回登录||注册的界面
    // 这里通过请求的参数不同来判断用户点击的是登录还是注册，注册的话界面需要翻转一下
    public function viewLogin()
    {
        return view('login');
    }

    public function login()
    {
        $request = Request::instance();
        $param = $request->param();


        // 1. 数据直接到数据库里查询
        $user_system_model = new UserSystemModel();
        $token = $user_system_model->login($param['username'], $param['pwd']);

        if ($token) {
            // 设置Cookie 有效期为 3600秒
            Cookie::set('token', $token, 3600 * 24 * 10);
            return $token;
        } else {
            return "login fail";
        }
    }

    public function register()
    {
        $request = Request::instance();
        $param = $request->param();

        // 注册
        // 0. 数据是否合法
        $is_lawful = $this->checkLawful($param);
        $is_uniq = null; // 当前要注册的用户和已注册的用户是否冲突
        $register_result = null; // 注册的结果，if == 1 is success
        if ($is_lawful) {
            // 1. 查询用户是否重复，
            $is_uniq = $this->checkUniq($param);
        } else {
            // 不合法的数据，提示用户
            // TODO 不要跳转页面，在当前页面向用户提示这个错误
            return "非法数据";
        }

        if ($is_uniq) {
            // 2. 在数据库创建一个用户
            $user_system_model = new UserSystemModel();
            $register_result = $user_system_model->createUser($param);
        } else {
            // TODO 不要跳转页面，在当前页面向用户提示这个错误
            return "用户名已存在 || 邮箱已经注册过";
        }

        if ($register_result == 1) {
            // 3. 跳转到登录页面
            $this->redirect('/login', ['result' => 'register success']);
        } else {
            return "注册出错";
        }
    }

    // TODO
    public function resetPassword()
    {
        return "resetPassword";
    }

    // TODO 检查提交的数据是否合法
    private function checkLawful($param)
    {
        return true;
    }

    // 检查用户名&邮箱是否重复
    private function checkUniq($param)
    {
        $user_system_model = new UserSystemModel();
        return $user_system_model->checkUniq($param);
    }

}