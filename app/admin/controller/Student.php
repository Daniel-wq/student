<?php
//命名空间
namespace app\admin\controller;
use houdunwang\view\View;
use system\model\Student as StudentModel;
use system\model\Grade;
use system\model\Attachment;
use Upload\Exception;
use Exception as MazhenyuException;


/**
 * 学生管理控制类（增删改）
 * Class Student
 * @package app\admin\controller
 */
class Student extends Common {
    /**
     * 学生列表
     * @return mixed
     */
    public function index(){
        //关联两张表的SQL语句
        $data = StudentModel::q("SELECT * FROM student JOIN grade on student.gid=grade.gid");
        //载入学生列表页，并把数据传入列表页中
        return View::make()->with(compact("data"));
    }

    /**
     * 添加学生信息
     * @return mixed
     */
    public function store(){
        //1、判断是否是POST请求
        //2、如果是POST请求，就执行以下代码，如果不是就不执行
        if(IS_POST){
            //所属班级的gid
            $gid = intval( $_POST['gid'] );
            //学生姓名
            $sname = $_POST['sname'];
            //头像
            //如果用户没有选择素材
            if($_FILES['profileupload']['error'] != 4){
                $profile = $this->upload();
            }else{//用户选择了素材，需要把素材添加到数据库
                $profile = $_POST['profile'];
            }
            //性别
            $sex = $_POST['sex'];
            //生日
            $birthday = $_POST['birthday'];
            //自我介绍
            $introduction = $_POST['introduction'];
            //向student表中添加数据的SQL语句
            $sql = "INSERT INTO student (gid,sname,profile,sex,birthday,introduction) VALUES ('{$gid}','{$sname}','{$profile}','{$sex}','{$birthday}','{$introduction}')";
            //调用无结果集的操作e方法
            StudentModel::e($sql);
            //添加成功跳转并提示用户
            $this->setRedirect(u('index'))->message('添加成功');
        }
        //1、获得班级数据
        //2、为了在页面输出使用
        $gradeData =Grade::get();
        //获得素材数据
        $attachmentData = Attachment::get();
        //载入添加页面，并把班级数据输出到页面中
        return View::make()->with(compact('gradeData','attachmentData'));
    }



    /**
     * 上传方法
     * @return string
     * @throws MazhenyuException
     */
    private function upload() {
        $dir = './attachment/' . date( 'ymd' );
        is_dir( $dir ) || mkdir( $dir, 0755, true );
        $storage = new \Upload\Storage\FileSystem( $dir );
        $file    = new \Upload\File( 'profileupload', $storage );

// Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName( $new_filename );

// Validate file upload
// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations( array(
            // Ensure file is of type "image/png"
//			new \Upload\Validation\Mimetype( 'image/png'),

            //You can also add multi mimetype validation
            new \Upload\Validation\Mimetype( array( 'image/png', 'image/gif', 'image/jpeg' ) ),

            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new \Upload\Validation\Size( '2M' )
        ) );

// Access data about the file that has been uploaded
        $data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        );


// Try to upload file
        try {
            // Success!
            $file->upload();

            //以下几行代码自己处理
            //完整文件名
            $fullPath = $dir . '/' . $data['name'];
//            //存入附件表
            Attachment::e("INSERT INTO attachment SET path='{$fullPath}',createtime=" . time());

            //返回文件名
            return $fullPath;

        } catch ( MazhenyuException $e ) {
            // Fail!
            throw new MazhenyuException( $file->getErrors()[0] );
        }
    }

    /**
     * 删除学生信息
     */
    public function remove(){
        //1、获得要删除的id
        //2、保证点击哪个删除哪个
        $sid = intval($_GET['sid']);
        //删除student表中对应数据的SQL语句
        $sql = "DELETE FROM student WHERE sid='{$sid}'";
        //调用无结果集的操作e方法
        StudentModel::e($sql);
        //删除成功后跳转并提示用户
        $this->setRedirect(u('index'))->message('删除成功');
    }

    /**
     * 修改学生信息
     * @return mixed
     */
    public function update(){
        //1、获得要修改的数据的id
        //2、保证点击哪个修改哪个
        $sid = intval($_GET['sid']);
        //判断是否是POST请求
        if (IS_POST){
            //所属班级的id
            $gid = intval($_POST['gid']);
            //学生姓名
            $sname = $_POST['sname'];
            //头像
            //如果用户通过file表单上传了图片
            if ($_FILES['profileupload']['error'] != 4){
                $profile = $this->upload();
            }else{//用户选择了素材，需要把素材添加到数据库
                $profile = $_POST['profile'];
            }
            //性别
            $sex = $_POST['sex'];
            //生日
            $birthday = $_POST['birthday'];
            //自我介绍
            $introduction = $_POST['introduction'];
            //组合修改student表中信息的SQL语句
            $sql = "UPDATE student SET sname='{$sname}',profile='{$profile}',sex='{$sex}',birthday='{$birthday}',introduction='{$introduction}',gid={$gid} WHERE sid={$sid}";
            //调用执行无结果及的e方法
            StudentModel::e($sql);
            //修改成功后的提示及跳转页面
            $this->setRedirect(u('index'))->message('修改成功');
        }
        //班级表数据
        $gradeData = Grade::get();
        //素材数据
        $attachmentData = Attachment::get();
        //获取学生旧数据
        $oldData = StudentModel::findArray($sid);
        return View::make()->with(compact('gradeData','attachmentData','oldData'));



    }

}
