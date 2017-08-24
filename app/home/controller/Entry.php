<?php
//命名空间
namespace app\home\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Grade;
use system\model\Student;

/**
 * 显示信息控制类
 * Class Entry
 * @package app\home\controller
 */
class Entry extends Controller{
    /**
     * 显示学生列表
     * @return mixed
     */
    public function index(){
        //关联两张表，获得其中的数据
        $data = Student::getStudentClassData();
        //载入页面并传入数据
        return View::make()->with(compact('data'));
    }

    /**
     * 显示学生信息
     * @return mixed
     */
    public function show(){
        //获得要显示信息的id
        $sid = intval($_GET['sid']);
        //从数据库中获得该sid的所有数据
        $data = Student::findArray($sid);

        //p($data);exit;
        /*
        Array
        (
            [sid] => 1
            [sname] => Daniel
            [profile] => ./attachment/170704/595b5a3caf129.jpg
            [sex] => 男
            [birthday] => 1993-01-26
            [introduction] => 吾若成佛  天下无魔，吾若成魔  佛奈我何！
            [gid] => 1
        )*/

        //从班级数据库中获得与学生信息数据库gid相同的班级名称并添加到$data数组中
        $data['grade']=Grade::findArray($data['gid']);

        //p($data['grade']);exit;
        /*
        Array
        (
            [gid] => 1
            [gname] => 81期
        )*/

        //p($data);exit;
        /*
        Array
        (
            [sid] => 1
            [sname] => Daniel
            [profile] => ./attachment/170704/595b5a3caf129.jpg
            [sex] => 男
            [birthday] => 1993-01-26
            [introduction] => 吾若成佛  天下无魔，吾若成魔  佛奈我何！
            [gid] => 1
            [grade] => Array
                    (
                        [gid] => 1
                        [gname] => 81期
                    )

        )*/


        //$gradeData = Student::getStudentClassData();
        //$g = current($gradeData);
        //p($gradeData);exit;
        /*
        Array
        (
            [0] => Array
            (
                [sid] => 1
                [sname] => Daniel
                [profile] => ./attachment/170704/595b5a3caf129.jpg
                [sex] => 男
                [birthday] => 1993-01-26
                [introduction] => 吾若成佛  天下无魔，吾若成魔  佛奈我何！
                [gid] => 1
                [gname] => 81期
            )

            [1] => Array
            (
                [sid] => 8
                [sname] => 东方
                [profile] => ./attachment/170704/595b5a4e8709d.jpg
                [sex] => 女
                [birthday] => 1992-02-05
                [introduction] => 大大大
                [gid] => 2
                [gname] => c83
            )

            [2] => Array
                (
                    [sid] => 10
                    [sname] => ADS
                    [profile] => ./attachment/170704/595b5a61f0c75.jpg
                    [sex] => 男
                    [birthday] => 1995-06-05
                    [introduction] => 阿斯达
                    [gid] => 1
                    [gname] => 81期
                )

            )*/
        //载入模板并传入数据
        return View::make()->with(compact('data'));
    }
}
