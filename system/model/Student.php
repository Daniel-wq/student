<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/1
 * Time: 22:14
 */

namespace system\model;


use daniel007\model\Model;

class Student extends Model{
    /**
     * 获取学生和班级的关联数据
     * @return mixed
     */
    public static function getStudentClassData(){
        return self::q("SELECT * FROM student s JOIN grade g ON s.gid=g.gid");
    }

}