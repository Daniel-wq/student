<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 15:32
 */

namespace app\admin\controller;
use houdunwang\view\View;
use system\model\Attachment as AttachmentModel;

/**
 * 素材控制类
 * Class Attachment
 * @package app\admin\controller
 */
class Attachment extends Common {

    /**
     * 素材列表
     * @return mixed
     */
    public function index(){
        $data = AttachmentModel::get();
        return View::make()->with(compact('data'));
    }

    /**
     * 删除素材
     */
    public function remove(){
        //获得要删除数据的id
        $aid = intval($_GET['aid']);
        //获得要删除数据的路径
        $path = $_GET['path'];
        //删除文件
        is_file($path) && unlink($path);
        //组合删除数据的SQL语句
        $sql = "DELETE FROM attachment WHERE aid={$aid}";
        //调用执行无结果集的e方法，执行SQL语句
        AttachmentModel::e($sql);
        //删除成功后提示及跳转页面
        $this->setRedirect(u('index'))->message('删除成功');
    }

}
















