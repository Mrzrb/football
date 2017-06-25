<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;

class Auth extends Controller
{
    public function index()
    {
        
    }

    public function login(Request $request)
    {
        if( empty($request->post()) )
        {
            return $this->fetch();
        }else{
            $admin = Db::name('admin')->where('name',$request->post('name'))->select();
            // dump($admin);echo '<br />';
            // dump($request->post());die;
            if(empty($admin))
            {
                $this->error('无此用户','auth/login');
            }elseif($admin[0]['password'] != $request->post('password')){
                $this->error('用户名密码错误','auth/login');
            }else{
                \think\Session::set('is_login',true,'think');
                $this->success('login success','index/index');
            }
        }
        
    }
}