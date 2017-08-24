<?php
//1、创建命名空间
//2、之所以这样命名，是为了符合composer中的psr-4规则
namespace houdunwang\core;
/**
 * 框架启动类
 * Class Boot
 * @package houdunwang\core
 */
class Boot{
    //1、定义run方法
    //2、供外部（public/index.php）调用
    public static function run(){
        //错误处理
        self::handelError();
        //初始化框架
        self::init();
        //执行应用
        self::appRun();
    }

    /**
     * 错误处理
     */
    static private function handelError() {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler( new \Whoops\Handler\PrettyPageHandler );
        $whoops->register();

    }
    //初始化框架方法
    private static function init(){
        //1、开启session
        //2、如果已经开启session就执行session_id,如果没有就开启session
        session_id() || session_start();
        //1、设置时区
        //2、为了在页面输出正确的时间
        date_default_timezone_set('PRC');
        //1、定义一个IS_POST常量
        //2、为了判断是否是提交文件
        define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
        //1、定义__ROOT__常量
        //2、为了方便组合路径使用
        define('__ROOT__','http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
    }
    /**
     * 1、定义appRun方法
     * 2、为了设置浏览器get参数
     */
    private static function appRun(){
        //最终想要到结果样式
        //index.php?s=home/entry/index;
        //p($_GET);

        //1、判断浏览器地址栏是否是get参数
        //2、如果是get地址参数，就执行相应的操作
        if (isset($_GET['s'])){
            $info = explode('/',$_GET['s']);
            //p($info);
            //模块
            $m = strtolower($info[0]);
            //控制器
            $c = strtolower($info[1]);
            //方法
            $a = strtolower($info[2]);
            //如果没有get地址参数，那么设置默认get地址参数为index.php?s=home/entry/index;
        }else{
            //模块
            $m = 'home';
            //控制器
            $c = 'entry';
            //方法
            $a = 'index';
        }

        //1、定义三个常量
        //2、为了在houdunwang/view/Base.php中的make方法中组合模板路径的使用
        define('MODULE',$m);
        define('CONTROLLER',$c);
        define('ACTION',$a);

        //new \app\home\controller\Entry();
        //1、将控制器首字母大写
        //2、因为类名首字母是大写的
        $controller = ucfirst($c);
        //1、组合实例化对象路径
        //2、路径如 \app\home\controller\Entry()
        //其中app controller是固定的  home与Entry是可变变量控制的
        $class = "\app\\{$m}\controller\\{$controller}";
        //1、执行对应的方法
        //2、通过输出，触发view中Bass中的__toString方法
        echo call_user_func_array([new $class,$a],[]);

    }
}
