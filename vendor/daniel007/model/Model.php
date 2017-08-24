<?php
//命名空间
namespace daniel007\model;
class Model{
    private static $config;
    /**
     * 当实例化调用时，触发该方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        //调用当前类中的parseAction方法
        return self::parseAction($name,$arguments);
    }
    /**
     * 当静态调用模板时，自动调用
     * @param $name 静态类名
     * @param $arguments 参数
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        //调用当前类中的parseAction方法
        return self::parseAction($name,$arguments);
    }
    /**
     * 在调用上述两种方法时自动触发该方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    private static function parseAction($name,$arguments){
        //system\model\Article
        //1、获得数据类名
        //2、首先获得命名空间
        $table = get_called_class();
        //1、把获得的值从右开始按照“/”截取，并去掉左边的“/”，并把这个值转为小写
        //2、因为类名与表名是一致的，又因为类名是大写的，但是表名是小写的，现在的$table要得到 的是表名，所以要转为小写
        $table= strtolower(ltrim(strrchr($table,'\\'),'\\'));
        //实例化Base这个类，并把值返回出去，
        return call_user_func_array([new Base(self::$config,$table),$name],$arguments);
    }
    //将数据库配置传到model里
    public static function setConfig($config){
        self::$config = $config;
    }
}
