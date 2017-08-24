<?php

//命名空间
namespace app\admin\controller;
use houdunwang\view\View;

class Entry extends Common{
    //建立一个进入首页的方法
    public function index(){
        //引入首页页面
        return View::make();
    }
}
