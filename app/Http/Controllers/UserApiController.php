<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\User;
class UserApiController extends Controller
{
    //Curl
    public function curl(Request $request){
            $url='http://1809a.apitest.com/api/u?uid=2';
            //创建一个连接资源
            $ch=curl_init($url);
            $data=curl_exec($ch);
            $code=curl_errno($ch);
            curl_close($ch);
    }
    //curlpost方式传输数组
    public function curlPost(){
        $url='http://1809a.apitest.com/api/curlPost1';
//        初始化
        $arr=[
            'nickname'=>'张三',
            'sex'=>'男',
            'age'=>18
        ];
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        $data=curl_exec($ch);
        print_r($data);
        curl_close($ch);
    }
    //curlpost方式传输application/x-www-form-urlencoded格式的数据
    public function curlPost1(){
        $url='http://1809a.apitest.com/api/curlPost1';
//        初始化
        $str="nickname=zhangsan&age=18&sex=男";
        $ch=curl_init();
        //初始化路径
        curl_setopt($ch,CURLOPT_URL,$url);
        // 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //使用post方式请求
        curl_setopt($ch,CURLOPT_POST,1);
        //请求携带的参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
        //获取信息
        $data=curl_exec($ch);
        print_r($data);
        curl_close($ch);
    }
    //curlpost方式传输json串格式的数据
    public function curlPost2(){
        $url='http://1809a.apitest.com/api/curlPost1';
//        初始化
        $arr=[
            'nickname'=>'张三',
            'sex'=>'男',
            'age'=>18
        ];
        $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
        $ch=curl_init();
        //初始化路径
        curl_setopt($ch,CURLOPT_URL,$url);
        // 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //使用post方式请求
        curl_setopt($ch,CURLOPT_POST,1);
        //请求携带的参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
        //将请求数据格式定义成字符串
//        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        //获取信息
        $data=curl_exec($ch);
        print_r($data);
        curl_close($ch);
    }
    public function testmid(){
        echo __METHOD__;
    }
}

