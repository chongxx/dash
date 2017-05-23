<?php
namespace app\index\controller;
/**
 * Created by PhpStorm.
 * User: dashzhao
 * Date: 5/23/17
 * Time: 11:06 PM
 */
class InitDb
{

    private $server = "localhost";
    private $username = "root";
    private $password = "root";


    public function init()
    {

        // 创建连接
        $conn = new mysqli($this->server, $this->username, $this->password);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }

        // 创建数据库
        $sql = "CREATE DATABASE stump;
           USE stump;
           CREATE TABLE IF NOT EXISTS `user`(
                `id` int(10) NOT NULL AUTO_INCREMENT,
                `name` varchar(30) NOT NULL,
                PRIMARY KEY (`id`)
           );";
        if ($conn->query($sql) === TRUE) {
            echo "数据库创建成功";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        $conn->close();
    }

}