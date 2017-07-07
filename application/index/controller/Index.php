<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\model\news as news;
use app\common\model\Article as Art;
use app\index\model\member as mem;

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
        // dump($arts);die;
        foreach($arts as $k => $v)
        {
            $arts[$k]['content'] = setImgStyle($v['content'],100);
        }
        $this->assign('arts',$arts);
        return $this->fetch();
    }


    public function join(Request $request){
        if(empty($request->post()))
        {
            return $this->fetch();
        }else{
            // dump($request->post());die;
            $mem = new mem();
            $mem->name = $request->post('name');
            $mem->role = $request->post('role');
            $mem->institute = $request->post('institute');
            $mem->phoneNum = ''.$request->post('phoneNum');
            dump($mem->save());
        }
    }


    public function test()
    {
        $arts = Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select();
        dump($arts);
    }


    public function send($from=0,$num=0){
        $arts =  Db::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->limit($from,$num)->select();
        // if(arts){
            return json_encode($arts,JSON_UNESCAPED_UNICODE);
        // }else return 1;
    }
}
