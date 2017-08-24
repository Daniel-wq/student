<?php
//1、创建命名空间
//2、之所以这样命名，是为了符合composer中的psr-4规则
namespace daniel007\model;
use \PDOException;
use \PDO;
/**
 * 链接数据库
 * Class Base
 * @package houdunwang\model
 */
class Base{
    //建立一个私有静态属性$pdo,并赋值为null
    //方便全局调用
    private static $pdo = NULL;
    //建立一个私有的属性$table
    //方便全局调用
    private $table;
    //建立一个私有属性$where,并赋值空字符串
    //方便全局调用
    private $where= '';

    /**
     * 1、构造函数
     * 2、实例化对象后，自动执行connect 方法，并将数据库的表格信息拿到
     * Base constructor.
     * @param $config
     * @param $table
     */
    public function __construct($config,$table)
    {
        //1、调用当前类中的connect方法
        //2、在外部实例化这个类时，会自动触发这个构造方法，就会自动调用这个方法
        $this->connent($config);
        //调用当前类中的$table 属性，并赋值$table
        $this->table = $table;
    }

    /**
     * 链接数据库
     * @param $config
     */
    public function connent($config){
        //1、判断属性$pdo是否已存在
        //2如果属性$pdo已经链接过数据库了，不需要重复链接了
        if (!is_null(self::$pdo)) return;
        try{
            //数据库地址
            $dsn = "mysql:host=" . $config['db_host'] . ";dbname=" . $config['db_name'];
            //数据库用户名
            $user = $config['db_user'];
            //数据库密码
            $password = $config['db_password'];
            //使用数据库
            $pdo = new PDO($dsn,$user,$password);
            //设置错误
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //设置字符集
            $pdo->query("SET NAMES " . $config['db_charset']);
            //存到静态属性里
            self::$pdo = $pdo;
        }catch(PDOException $e){
            //如果出现异常错误，从这里获得，用户可以对错误信息自行操作
            exit($e->getMessage());
        }
    }
    /**
     * 输出信息时的where 条件
     * @param $where
     * @return $this
     */
    public function where($where){
        $this->where = "WHERE {$where}";
        return $this;
    }

    /**
     * 获得数组中最基础的数据信息
     * @param $sql
     * @return mixed
     */
    public function q($sql){
        try{
            $result = self::$pdo->query($sql);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }


    /**
     * 获取全部数据
     * @return mixed
     */
    public function get(){
        $sql = "SELECT * FROM {$this->table} {$this->where}";
        return $this->q($sql);
    }


    /**
     * 查看符合条件的信息的总数
     * @param string $field
     * @return mixed
     */
    public function count($field='*'){
        $sql = "SELECT count({$field}) as c FROM {$this->table} {$this->where}";
        $data = $this->q($sql);
        return $data[0]['c'];
    }

    /**
     * 获得表的主键
     * @return string
     */
    public function getPri(){
        $desc = $this->q("DESC {$this->table}");
        //p($desc);
        $priField = '';
        foreach ($desc as $v){
            if ($v['Key'] == 'PRI'){
                $priField = $v['Field'];
                break;
            }
        }
        return $priField;
    }

    /**
     * 按条件查找数据库信息
     * @param $pri
     * @return $this
     */
    public function find($pri){
        //获得主键字段，比如cid还是aid
        $priField = $this->getPri();
        $this->where("{$priField}={$pri}");
        $sql= "SELECT * FROM {$this->table} {$this->where}";
        $data = $this->q($sql);
        //把原来的二位数组变为一维数组
        $data = current($data);
        $this->data = $data;
        return $this;
    }

    //同find方法一起使用，实现查看效果
    public function toArray(){
        return $this->data;
    }


    /**
     *同find方法和toArray方法合起来用的效果一样
     * @param $pri
     * @return mixed
     */
    public function findArray($pri){
        $obj = $this->find($pri);
        return $obj->data;
    }

    /**
     * 执行无结果集的操作方法，例如增删改
     * @param $sql
     * @return mixed
     */
    public function e($sql){
        try{
            //调用pdo对象中的exec方法（exec用来执行无结果集操作）
            return   self::$pdo->exec($sql);
        }catch(PDOException $e){
            //如果捕获到pdo的异常错误，就输出错误，并终止代码运行
            exit($e->getMessage());
        }
    }
}
