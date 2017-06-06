<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 6/3/17
 * Time: 12:54 AM
 */

namespace app\index\model;


use app\tools\EncryptTool;
use think\Db;
use think\db\exception\BindParamException;
use think\Model;

class UserSystemModel extends Model
{

    private static $slat = 'dash';

    public function createUser($param)
    {
        $pwd = $param['pwd'];
        $pwd = md5($pwd . $param['username'] . self::$slat);
        $result = Db::table('user')->insert([
            'user_name' => $param['username'],
            'pwd' => $pwd,
            'register_time' => time(),
            'email' => $param['email'],
            'last_login' => 0,
        ]);

        return $result;
    }

    public function login($username, $pwd)
    {

        $check_user_result = $this->checkUser($username, $pwd);

        if ($check_user_result) {
            // 生成一个 token 保存到对应的user 数据里，并且返回给调用者
            return $this->createToken($username);
        }
    }

    // 检查用户的用户名和密码是否正确
    private function checkUser($username, $pwd)
    {
        $pwd = md5($pwd . $username . self::$slat);
        $user = Db::table('user')
            ->where('user_name', $username)
            ->where('pwd', $pwd)
            ->find();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    // 生成一个用户token
    // 默认过期时间7天
    private function createToken($username, $overdue = 864000)
    {

        $time = time();
        $encrypt_tool = new EncryptTool();

        // 过期时间 + 用户名（携带信息） + （随机数 + 盐）
        // token 的过期时间
        $a = $encrypt_tool->encode($time + $overdue);
        // 这个token是谁的
        $b = $encrypt_tool->encode(json_encode(['username' => $username]));
        // 判断是否是OK的用户，
        $c = $encrypt_tool->encode(random_int(0, 9999999) . 'dash');

        $token = $a . '.' . $b . '.' . $c;

        $result = Db::table('user')
            ->where('user_name', $username)
            ->update([
                'token' => $token
            ]);

        if ($result == 1) {
            return $token;
        }
    }

    public function checkToken($token)
    {
        $token_arr = explode('.', $token);
        length

        if（$token_arr）


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