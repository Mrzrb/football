<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Article as _Article;
use app\admin\model\Category as Cat;

class Article extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $articles = (new _Article())->paginate(10);
        $curr = request()->get('page');
        $this->assign('curr',$curr);
        $this->assign('articles',$articles);
        return $this->fetch();
    }



    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
         if(empty($request->post()))
        {
            $cats = Cat::all();
            $this->assign('cats' , $cats);
            return $this->fetch();
        }else{
            $artadd = new _Article();
            $artadd->title = $request->post('title');
            $artadd->content = $request->post('content');
            $artadd->tags = $request->post('tags');
            $artadd->cat_id = $request->post('cat_id');
            $artadd->save();
            $this->redirect('/admin/article');
        }
    }





    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request , $id)
    {
        $updateArt = new _Article();
        if(empty($request->post())){
            $cats = Cat::all();
            $this->assign('cats' , $cats);

            $article = $updateArt->find($id);
            $this->assign('article',$article);
            return $this->fetch();
        }else{
            $updateArt = _Article::get($id);
            $updateArt->title = $request->post('title');
            $updateArt->content = $request->post('content');
            $updateArt->tags = $request->post('tags');
            $updateArt->cat_id = $request->post('cat_id');
            $updateArt->save();
            $this->redirect('admin/article/index');
        }
    }



    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $delArt = new _Article();
        $delArt->destroy($id);
        $this->redirect('/admin/article');
    }
}
