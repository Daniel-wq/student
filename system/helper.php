<?php
//此文件的函数会被自动加载
function dd($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
function v($path){
    $arr = explode('.',$path);
    $config = include "../system/config/{$arr[0]}.php";
    return isset($config[$arr[1]]) ? $config[$arr[1]] : null;
}