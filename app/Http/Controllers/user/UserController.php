<?php

namespace App\Http\Controllers\user;

use App\model\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    //用户注册
    public  function reg(Request $request){
        $user_name=$request->input('user_name');
        $pass=$request->input('pass');
        $repass=$request->input('repass');
        $email=$request->input('email');
        $age=$request->input('age');
        if($pass!=$repass){
            $response=[
                'errno'=>'60002',
                'msg'=>'两次密码不一致'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $data=[
            'user_name'=>$user_name,
            'pass'=>password_hash($pass,PASSWORD_BCRYPT),
            'email'=>$email,
            'age'=>$age,
        ];
        $email=Users::where('email',$email)->first();
        if($email){
            $response=[
                'errno'=>'60004',
                'msg'=>'邮箱已经注册',
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $res=Users::insertGetId($data);
        if($res){
            $response=[
                'errno'=>'0',
                'msg'=>'ok',
            ];
        }else{
            $response=[
                'errno'=>'60004',
                'msg'=>'注册失败，未知错误',
            ];
        }
        die(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
    //用户登录
    public function login(Request $request){
        $user_name=$request->input('user_name');
        $pass=$request->input('pass');
        $res=Users::where('user_name',$user_name)->first();
        if($res){
            if(password_verify($pass,$res->pass)){
                $token=$this->createUserToken($res->id);
                $key='user:token'.$res->id;
                Redis::set($key,$token);
                Redis::expire($key,604800);
                $response=[
                    'errno'=>'0',
                    'msg'=>'登录成功',
                    'token'=>$token
                ];
            }else{
                $response=[
                    'errno'=>'60006',
                    'msg'=>'密码错误'
                ];
            }
        }else{
            $response=[
                'errno'=>'60005',
                'msg'=>'用户不存在'
            ];
        }
        return json_encode($response,JSON_UNESCAPED_UNICODE);
    }
    //用户中心
    public function My(){
        echo __METHOD__;
    }
    //登录成功生成用户token
    protected function createUserToken($id){
        return substr((sha1($id).time().Str::random(16)),6,16);
    }
}
