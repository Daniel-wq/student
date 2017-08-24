<?php
//命名空间
namespace houdunwang\core;
/**
 * 公共Controller
 * 为了以后需要跳转提示效果时，可以直接继承使用
 * Class Controller
 * @package houdunwang\core
 */
class Controller{
    private $url = 'window.history.back()';
    /**
     * 跳转
     * @param string $url
     * @return $this
     */
    protected function setRedirect($url = ''){
        //1、判断是否有路径传入
        //2、如果没有路径传入，就回到历史页面
        if (empty($url)){
            //如果有路径传入，就进入执行相应的操作
            $this->url = "window.history.back()";
            //如果有路径传入，就进入执行相应的操作
        }else{
            $this->url = "location.href='{$url}'";
        }
        //返回当前对象，实现跳转调用
        return $this;
    }
    /**
     * 消息提示
     * @param $msg
     */
    protected function message($msg){
        //1、载入提示页面
        //2、为了显示提示信息
        include './view/message.php';
        exit();
    }
}
