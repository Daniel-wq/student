<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/1
 * Time: 19:21
 */
//命名空间
namespace app\admin\controller;
use houdunwang\view\View;
use system\model\Grade as GradeModel;

/**
 * 班级管理类（曾删改）
 * Class Grade
 * @package app\admin\controller
 */
class Grade extends Common {
    /**
     * 班级列表
     * @return mixed
     */
    public function index(){
        //1、调用get方法，从数据库中获取数据
        //2、因为要从数据库中获得数据输出到页面
        $data = GradeModel::get();
        //载入页面并把数据传入页面中
        return View::make()->with(compact('data'));
    }

    /**
     * 添加班级信息
     * @return mixed
     */
    public function store(){
        //1、判断是否是POST请求
        //2、如果是POST请求，就执行以下代码，如果不是就不执行
        if (IS_POST){
            //向grade表中添加数据的SQL语句
            $sql = "INSERT INTO grade SET gname='{$_POST['gname']}'";
            //调用无结果集的操作e方法
            GradeModel::e($sql);
            //添加成功跳转并提示用户
            $this->setRedirect(u('index'))->message('添加成功');
        }
        //载入添加页面
        return View::make();
    }

    /**
     * 修改班级信息
     * @return mixed
     */
    public function update(){
        //1、获得要修改的数据的id
        //2、保证点击哪个修改哪个
        $gid = intval($_GET['gid']);
        //1、判断是否是POST请求
        //2、如果是POST请求，就执行以下代码，如果不是就不执行
        if (IS_POST){
            //修改student表中对应数据的SQL语句
            $sql = "UPDATE grade SET gname='{$_POST['gname']}' WHERE gid={$gid}";
            //调用无结果集的操作e方法
            GradeModel::e($sql);
            //修改成功后跳转并提示用户
            $this->setRedirect(u('index'))->message('修改成功');
        }
        //调用Grade类中的findArray方法，
        //因为findArray方法是用来寻找数据库中的某一项数据
        $data = GradeModel::findArray($gid);
        //载入修改页面并把得到的值输出到页面中
        return View::make()->with(compact('data'));

    }

    /**
     * 删除班级信息
     */
    public function remove(){
        //1、获得要删除的id
        //2、保证点击哪个删除哪个
        $gid = intval($_GET['gid']);
        //先判断该班级是否有学生
        if (\system\model\Student::where("gid={$gid}")->get()){
            $this->setRedirect(u('index'))->message('请先删除班级下面的学生');
        }
        //删除student表中对应数据的SQL语句
        $sql = "DELETE FROM grade WHERE gid={$gid}";
        //调用无结果集的操作e方法
        GradeModel::e($sql);
        //删除成功后跳转并提示用户
       $this->setRedirect(u('index'))->message('删除成功');
    }
}
