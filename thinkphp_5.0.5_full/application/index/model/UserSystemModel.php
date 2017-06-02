<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 6/3/17
 * Time: 12:54 AM
 */

namespace app\index\model;


use think\Db;
use think\db\exception\BindParamException;
use think\Model;

class UserSystemModel extends Model
{
    public function createUser($param)
    {
        $pwd = $param['pwd'];
        $pwd = md5($pwd . $param['username'] . 'dash');
        $result = Db::table('user')->insert([
            'user_name' => $param['username'],
            'pwd' => $pwd,
            'register_time' => time(),
            'email' => $param['email'],
            'last_login' => 0,
        ]);

        return $result;
    }

    // 检查用户名或者邮箱是否重复
    // TODO 返回值要来说明是用户名重复还是邮箱重复
    public function checkUniq($param)
    {
        $result = Db::table('user')
            ->where('user_name', $param['username'])
            ->whereor('email', $param['email'])
            ->find();

        if ($result != null) {
            return false;
        } else {
            return true;
        }
    }
}