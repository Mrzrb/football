<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Notice extends Controller
{
    public function index(Request $request)
    {
        if(!$request->post())
        {
            $notice = (new Db())::table('news')->select();
            // dump($notice);die;
            $this->assign('data',$notice);
            return $this->fetch();
        }else{

            $notice = $request->post();
            $update = new \app\index\model\news();
            $update->where('1=1')->delete();
            $list = [
                    ['title'=> $notice['notice0Main'],'content'=>$notice['notice0Sub'],'flag'=>0 ],
                    ['title'=> $notice['notice1Main'],'content'=>$notice['notice1Sub'], 'flag'=>1]
                    ];
            $update->saveAll($list);
            $this->redirect('/admin/notice');
        }
    }
}





// public function index(Request $request)
//     {
//         if(!$request->post())
//         {
//             $data = json_decode(file_get_contents(\think\Config::get('noticeDir').'/declaration.json'),true);
//             $fac = new \fileFactory\FileFactory($data);
//             $data = $fac->decode();
//             $this->assign('data',$data);
//             return $this->fetch();
//         }else{
//             $notice = $request->post();

//             $fac = new \fileFactory\FileFactory($notice);
//             $notice = $fac->encode();
//             // foreach($notice as $k => $v){
//             //     $notice[$k] = urlencode($v);
//             // }
//             $notice = json_encode($notice);
//             $file = \think\Config::get('noticeDir');
//             is_dir($file)||mkdir($file,0777,true);
//             file_put_contents($file.'/declaration.json',$notice);
//             $this->redirect('/admin/notice');
//             // $this->success('admin','admin');
//         }
//     }