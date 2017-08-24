<?php
//建立打印函数
function p($var){
    echo '<pre>' . print_r($var,true) . '</pre>';
}

//建立一个跳转函数，里面传入参数$url
function u($url){
    //定义一个变量，默认为空
    //为了在组合路径时使用
    $path = '';
    //把传入的参数$url按照"/"分割成数组
    //为了方便在组合路径时使用
    $arr = explode('/',$url);
    //$arr就是[0=>'lists'];
    switch (count($arr)){
        //u('index')
        case 1:
            $path = '?s=' . MODULE . '/' . CONTROLLER . '/' . $arr[0];
            break;
        //u('arc/lists')
        case 2:
            $path = '?s=' . MODULE . '/' . $arr[0] . '/' . $arr[1];
            break;
        case 3:
            $path = '?s=' . $arr[0] . '/' . $arr[1] . '/' . $arr[2];

    }
    //用__ROOT__和$path组合成一个路径，把路径返回给app\controller\Entry类的add方法中
    return __ROOT__ . $path;

}