<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Category as Cat;
use infiniteC\InfiniteC as tree;

class Category extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        if(empty($request->post()))
        {
            $categories = Cat::all();
            foreach($categories as $k => $v)
            {
                $categories[$k] = $v->toArray();
            }
            $sum = Cat::count();
            
            $categories = (new tree($categories,'cat_id','parent_id'))->getSon(-1);

            // dump($son);die;


            $this->assign('sum',$sum);
            $this->assign('categories',$categories);
            return $this->fetch();
        }else{
            $res = $this->create($request);
            if(!$res)
            {
                $this->error('添加失败','admin/category',1);
            }else{
                $this->redirect('/admin/category');
            }
        }


    }
    

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        $create = new Cat();
        $create->cat_name = $request->post('cat_name');
        $create->parent_id = $request->post('parent_id');
        // dump($create->create($request->post()));die;  
        return $create->save();
        
    }

   

   
    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        if(empty($request->post()))
        {
            $category = Cat::get($id);
            $all = Cat::all();
            $this->assign('category',$category);
            $this->assign('all',$all);
            return $this->fetch();
        }else{
            $update = Cat::get($id);
            $update->cat_name = $request->post('cat_name');
            $update->parent_id = $request->post('parent_id');
            $update->keywords = $request->post('keywords');
            $res = $update->save();
            if(!$res)
            {
                $this->error('修改失败','/admin/category');
            }else{
                $this->redirect('/admin/category');
            }
            
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
        $delete = new Cat();
        $delete->destroy($id);
        // $this->redirect('/admin/category');


        $categories = Cat::all();
            foreach($categories as $k => $v)
            {
                $categories[$k] = $v->toArray();
            }
            $sum = Cat::count();
            
            $categories = (new tree($categories,'cat_id','parent_id'))->getSon(-1);

            // dump($son);die;


            $this->assign('sum',$sum);
            $this->assign('categories',$categories);
            echo $this->fetch();


    }
}
