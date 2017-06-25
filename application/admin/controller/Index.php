<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Article as Article;
use think\Request;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function article()
    {
        $articles = (new Article())->select();
        $this->assign('articles',$articles);
        return $this->fetch();
    }

    public function artadd(Request $request)
    {
        if(empty($request->post()))
        {
            return $this->fetch();
        }else{
            $artadd = new Article();
            $artadd->title = $request->post('title');
            $artadd->content = $request->post('content');
            $artadd->cat_id = -1;
            $artadd->save();
            $this->redirect('/admin/index/article');
        }

    }

}
