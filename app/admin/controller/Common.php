<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/1
 * Time: 18:30
 */
//命名空间
namespace app\admin\controller;
//使用houdunwang\core命名空间下的Controller类
//因为不在一个命名空间下不可以使用
use houdunwang\core\Controller;

/**
 * 检测是否登陆
 * Class Common
 * @package app\admin\controller
 */
class Common extends Controller {
    //1、构造方法
    //2、在外部实例化或继承时会触发该方法
    public function __construct()
    {
        //1、调用当前类中authLogin方法
        //2、在触发该方法时会执行里面的代码，检测是否登录
        $this->authLogin();
    }

    /**
     * 检测是否已登陆
     */
    private function authLogin(){
        //1、判断session中的用户名是否存在
        //2、如果不存在就提示用户去登陆，并跳转到登陆页面
        if (!isset($_SESSION['user'])){
            //提示用户并跳转页面
            $this->setRedirect(u('user/login'))->message('请先登录再操作');
        }
    }
}
