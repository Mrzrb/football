<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\news as news;
use app\common\model\Article as Art;

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
        $arts =  Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select();
        $this->assign('arts',$arts);
        return $this->fetch();
    }

    public function test()
    {
        $arts = Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select();
        dump($arts);
    }
}
