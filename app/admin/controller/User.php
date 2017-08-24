<?php
//命名空间
namespace app\admin\controller;
use houdunwang\core\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use houdunwang\view\View;
use system\model\User as UserModel;

/**
 * 用户管理控制类
 * Class User
 * @package app\admin\controller
 */
class User extends Controller {
    /**
     * 用户登陆
     * @return mixed
     */
    public function login(){
        //1、判断是否是POST请求
        //2、如果是POST请求，就执行以下代码，如果不是就不执行
        if(IS_POST){
            //1、首先获得用户提交的验证码
            //2、为了做验证码判断时要用户提交的验证码与session中的验证码进行对比
            $captcha = strtolower($_POST['captcha']);
            //1、判断用户提交的验证码与session中的验证码是否一致
            //2、如果不一致提示用户，先验证验证码，因为如果验证码不正确，就不用遍历数据库，提高代码运行效率
            if ($captcha != $_SESSION['captcha']){
                //提示用户验证码错误
                $this->message('验证码错误');
            }
            //1、获得用户提交的用户名
            //2、为了将获得的用户名与数据库中的用户名进行对比
            $username = $_POST['username'];
            //1、调用User类中的where方法和get方法
            //2、因为要判断用户名是否存在，不止要获得用户提交的用户名，还要获得数据库中的用户名，进行比对
            $data = UserModel::where( "username='{$username}'" )->get();
            if ( ! $data ) {
                //1、如果得到的值不存在，表示用户名在数据库中不存在
                //2、提示用户'用户名不存在'
                $this->message( '用户名不存在' );
            }
            //1、获得用户提交的密码
            //2、为了将用户提交的密码与数据库中的密码进行对比
            $password = $_POST['password'];
            //如果数据库中的密码与用户提交之后通过MD5加密过后的密码不一致
            if ( $data[0]['password'] != md5( $password . 'student' ) ) {
                //提示用户，显示密码错误
                $this->message( '密码错误' );
            }

            //把从数据库中得到的值存入session中
            $_SESSION['user'] = [
                'uid'      => $data[0]['uid'],
                'username' => $data[0]['username']
            ];

            //如果用户有勾选该项
            if(isset($_POST['autologin'])){
                //设置cookie，有效期为一个月
                setcookie(session_name(),session_id(),time()+3600 * 24 * 30,'/');
            }else{
                //1、如果用户没有勾选该项
                //2、设置cookie，有效期为当前会话期间
                setcookie(session_name(),session_id(),0,'/');
            }
                //跳转页面提示用户登录成功
            $this->setRedirect(u('entry/index'))->message('登陆成功');

        }
        //载入用户首页模板
        return View::make();
    }

    /**
     * 退出登录
     */
    public function logout() {
        //删除session
        session_unset();
        session_destroy();
        //跳转页面提示用户退出成功
        $this->setRedirect(u('login'))->message('退出成功');
    }


    /**
     * 验证验证码
     */
    public function captcha(){
        header( 'Content-type: image/jpeg' );
        $phraseBuilder = new PhraseBuilder( v( 'captcha.captcha_len' ) );
        $builder       = new CaptchaBuilder( null, $phraseBuilder );
        $builder->build();
        //把验证码存入session
        $_SESSION['captcha'] = strtolower( $builder->getPhrase() );
        $builder->output();
    }

    /**
     * 修改密码
     * @return mixed
     */
    public function changePassword(){
        //1、判断session中的user是否存在
        //2、如果不存在，提示并跳转页面
        if(!isset($_SESSION['user'])){
            //跳转页面，并提示用户先登录
            $this->setRedirect(u('user/login'))->message('请先登陆再操作');
        }
        //1、判断是否是POST请求
        //2、如果是POST请求，就执行以下代码，如果不是就不执行
        if (IS_POST){
            //获得用户提交的第一个密码
            $NewPassword = $_POST['NewPassword'];
            //获得用户提交的第二个密码
            $ConfirmPassword = $_POST['ConfirmPassword'];
            //判断两次密码是否不一致
            if ($NewPassword != $ConfirmPassword){
                //输出提示信息，提示用户两次输入密码不一致
                $this->message('两次密码不一致');
            }
            //判断旧密码是否正确
            //获得用户提交的密码并加密
            $password = md5($_POST['password'] . 'student');
            //获得$_SESSION中的用户名
            $username = $_SESSION['user']['username'];
            //$data = UserModel::find( "password=md5('{$password}student')" )->get();
            //在数据库中查找符合该用户名所对应的密码
            $data = UserModel::where( "username='$username'" )->get();
            //p($_SESSION);
            //p($data);exit;
            //如果数据库中的密码与用户提交的密码不一致
            if ( $password != $data[0]['password'] ) {
                //输出提示信息，提示用户密码错误
                $this->message( '当前密码错误' );
            }
            //判断如果两次密码填写一致
            if ($NewPassword==$ConfirmPassword){
                //修改user表中对应数据的SQL语句
                $sql = "UPDATE user SET password=md5('{$NewPassword}student')";
                //调用无结果集的操作e方法
                UserModel::e($sql);

                //删除session信息
                session_unset();
                session_destroy();

                //跳转并提示用户修改成功
                $this->setRedirect(u('login'))->message('修改成功');
            }
        }
        //载入修改密码页面
        return View::make();
    }
}
