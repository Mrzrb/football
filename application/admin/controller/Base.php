<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    static protected $is_login = false;
    
    public function __construct()
    {
        parent::__construct();
        self::$is_login = \think\Session::get('is_login') ? true : false;
        if(self::$is_login === false){
            $this->error('请登录','auth/login');
        }
    }
}