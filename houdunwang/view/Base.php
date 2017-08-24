<?php
//命名空间
namespace houdunwang\view;
/**
 * 1、视图处理类
 * 2、用于处理视图加载、以及视图与控制器之间的相关逻辑
 * Class Base
 * @package houdunwang\view
 */
class Base{
    private $file;
    private $var = [];

    /**
     * 1、组合完整路径
     * 2、用于提供加载视图的完整路径
     * @return $this
     */
    public function make(){
        //模板路径
        //如："../app/home/view/entry/index.php";
        //对应的文件夹名是和类名同名的，所以可以这样写
        //对应文件夹中的文件是和类中的方法同名的
        $this->file = "../app/" . MODULE . "/view/" . CONTROLLER . "/" . ACTION . ".php";
        //返回当前对象，实现链式调用所以要返回一个对象
        return $this;
    }

    /**
     * 1、连接数据
     * 2、为了用于接收controller中的数据进而可以使用controller中的数据
     * @param $data
     * @return $this
     */
    public function with($data){
        //将数据保存在属性中
        $this->var = $data;
        //返回当前对象，实现链式调用
        return $this;
    }

    /**
     * 当echo对象时自动触发
     * 将完整路径与参数组合成最终完整模板
     * @return string 必须返回字符串
     */
    public function __toString()
    {
        //把键名变为变量名，键值变为变量值
        extract($this->var);//相当于$data = 'hdphphmi';
        //1、载入视图
        //2、为了在链式调用时，无论是先加载视图后载入数据，还是先载入数据再加载视图，都是可执行的
        include $this->file;
        //必须返回字符串
        return '';
    }
}
