<?php
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/24/17
 * Time: 12:02 AM
 */

namespace app\index\controller;


use think\Db;
use think\Request;

class User
{
    public function create()
    {
        $req = Request::instance();
        $id = $req->param('id');
        $name = $req->param('name');
        $user = ['id' => $id, 'name' => $name];
        $result = Db::table('user')->insert($user);

        if ($result == 1) {
            return "add user success";
        } else {
            return "add user fail";
        }
    }

    public function getAll()
    {
        $users = Db::table('user')->select();
        return json_encode($users);
    }

}