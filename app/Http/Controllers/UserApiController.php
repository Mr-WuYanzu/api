<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\User;
class UserApiController extends Controller
{
    //获取用户信息
    public function userInfo(Request $request){
        $uid=$_POST['uid'];
//        获取用户信息
        $data=[];
        $where=[
            'uid'=>$uid
        ];
        $userInfo=User::where($where)->first();
        if($userInfo){
            $data=[
                'errno'=>0,
                'msg'=>'ok'
            ];
        }
    }
}
