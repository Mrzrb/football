<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\news as news;

class Index extends Controller
{
    public function index()
    {
        $this->redirect('/mainpage');
    }

    public function mainpage()
    {
        $newsModel = new news();
        $news = $newsModel->find();
        $this->assign('news',$news); 
        return $this->fetch();
    }

    public function news()
    {
        return $this->fetch();
    }
}
