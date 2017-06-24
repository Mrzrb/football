<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        $data = Db::name('news')->find();
        $this->assign('result',$data);
      
        return $this->fetch(); 
    }

    public function mainpage()
    {
        return $this->fetch();
    }

    public function news()
    {
        return $this->fetch();
    }
}
