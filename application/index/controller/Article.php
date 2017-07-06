<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article as artmodel;

class Article extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request,$id=-1)
    {
        
        $article = (new \think\Db())::table('article')->alias('art')->join('category cat','art.cat_id=cat.cat_id')->select($id)[0];
        
        if($article === null) abort(404,'文章号错误');
        $article['content'] = setImgStyle($article['content'],100);
        $this->assign('article',$article);
        return $this->fetch();
    }
}
