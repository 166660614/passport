<?php

namespace App\Http\Controllers\User;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;

class LoginRegister extends Controller
{
    public function ulogin(){
        $uname=$_POST['uname'];
        $upwd=$_POST['upwd'];
        $where=[
            'user_name'=>$uname,
            'user_pwd'=>$upwd,
        ];
        $user_data=UserModel::where($where)->first();
        $ktoken='token:u:'.$user_data['user_id'];
        $token=$token=str_random(32);
        $htoken=Redis::hSet($ktoken,'app:token',$token);
        Redis::expire($ktoken,60*5);
        if($user_data){
            $data=[
                'errcode'=>'4001',
                'errmsg'=>'登录成功'
            ];
        }else{
            $data=[
                'errcode'=>'5001',
                'errmsg'=>'账号或者密码错误'
            ];
        }
        return $data;
    }
    public function uregister(){
        $uname=$_POST['uname'];
        $upwd=$_POST['upwd'];
        $uemail=$_POST['uemail'];
        $info=[
            'user_name'=>$uname,
            'user_pwd'=>$upwd,
            'user_email'=>$uemail
        ];
        $res=UserModel::insert($info);
        if($res){
            $data=[
                'errcode'=>'4001',
                'errmsg'=>'注册成功'
            ];
        }else{
            $data=[
                'errcode'=>'5001',
                'errmsg'=>'注册失败'
            ];
        }
        return $data;
    }
    public function login(){
        return view('user.login');
    }
}
