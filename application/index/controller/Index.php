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
        $news = $newsModel->where('flag=0')->find();
        $this->assign('news',$news); 
        return $this->fetch();
    }

    public function news()
    {
        $newsModel = new news();
        $news = $newsModel->where('flag=1')->find();
        $this->assign('news',$news); 
 
        $arts =  Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select();
        // $arts =  Db::table('article')->select();
        // dump($arts);die;
        // dump($arts);die;
        $this->assign('arts',$arts);
        return $this->fetch();
    }

    public function test()
    {
        $arts = Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select();
        dump($arts);
    }
}
