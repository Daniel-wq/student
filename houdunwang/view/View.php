<?php
//1、创建命名空间
//2、之所以这样命名，是为了符合composer中的psr-4规则
namespace houdunwang\view;
/**
 *1、设置两种自动触发的方法
 * 2、为了在调用类中的方法时，没有找到相应方法时会自动那个触发以下两种方法
 * Class View
 * @package houdunwang\view
 */
class View{
    /**
     * 当静态调用模板时，自动调用
     * @param $name 静态类名
     * @param $arguments 参数
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        //实例化Bass类，并调用其中的方法
        return call_user_func_array([new Base,$name],$arguments);
    }
    /**
     * 当实例化调用时，触发该方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        //实例化Bass类，并调用其中的方法
        return call_user_func_array([new Base,$name],$arguments);
    }
}
