<?php
//此文件必须被加载之后才能执行
use daniel007\model\Model;
$config = [
    'db_host'=>'47.93.222.57',
    'db_user'=>'showdaniel',
    'db_password'=>'wangqiang',
    'db_name'=>'showdaniel',
    'db_charset'=>'utf8'
];
Model::setConfig($config);