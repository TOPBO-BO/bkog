<?php
namespace app\Admin\controller;
use app\admin\controller\Comm;
use app\Admin\model\Article as ArticleModel;
class Article extends Comm
{
    public function article_add()
    {
        if(request()->isPost()) {
            
            $data=[
                'id'=>input('id'),
                'title'=>input('title'),
                'author'=>input('author'),
                'keyword'=>input('keyword'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
                'desc'=>input('desc'),
                'pic'=>input('pic'),
                'time'=>time(),
            ];
            // dump($data);die;
            if ($_FILES['pic']['tmp_name']) {
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . '/public' . DS . 'static/uploads');

                $data['pic']='/static/uploads/'.$info->getsavename();
            }
             

            $validate = \think\Loader::validate('Article');
            if(!$validate->check($data)){
              $this->error($validate->getError());
             die;
            }           
            if(db('article')->insert($data)) {
                return $this->success('成功!','article_list');
            }else{
                return $this->error('失败!');
            }
         return;
    }
    $articles=db('column')->select();
    $this->assign('articles',$articles);
        return $this->fetch();
    }

       public function article_list()
    {
        $list =ArticleModel::paginate(5);
        $this->assign('list',$list);
        return $this->fetch();
    }

       public function article_edit(){
          $id=input('id');
          $articles=db('article')->find($id);
        if (request()->isPost()) {
              $data=[
            'id'=>input('id'),
            'username'=>input('username'),
            // 'password'=>input('newpassword'),
        ];

        // if(input('password')){
        //     $data['password']=input('password');
        //    }else{
        //     $data['password']=$articles['password'];
        //    }
        //    if ($data['password']!=$articles['password']) {
        //        return $this->error(密码no);
        //    }die;
        if (db('article')->update($data)) {
            return $this->success('yes!');
        }else{
            return $this->error('no!');
        }

        return;
    } 
       $this->assign('articles',$articles);
        return $this->fetch();
    }

     public function article_del()
    {
        $id=input('id');
        $del=db('article')->delete(input('id'));
        if($del){
            $this->success('ok');
        }else{
            $this->error('no');
        }
        //不可以修改初管理员
        // if ($id!=1) {
        //     if ($del) {
        //        $this->success('删除成功！','article_list');
        //     }else{
        //         $this->error('删除失败！');
        //     }else{
        //         $this->error('不可以删除！');
        //     }
        // }
        return $this->fetch();
    }   
    
      public function article_add_edit()
    {     
        $id=input('id');
          $articles=db('article')->find($id);
         if(request()->isPost()) {
          
            $data=[
                'id'=>input('id'),
                'title'=>input('title'),
                'author'=>input('author'),
                'keyword'=>input('keyword'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
                'desc'=>input('desc'),
                'pic'=>input('pic'),
                'time'=>time(),
            ];
            // dump($data);die;
            if ($_FILES['pic']['tmp_name']) {
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . '/public' . DS . 'static/uploads');

                $data['pic']='/static/uploads/'.$info->getsavename();
            }
             

            $validate = \think\Loader::validate('Article');
            if(!$validate->check($data)){
              $this->error($validate->getError());
             die;
            }           
             if (db('article')->update($data)) {
            return $this->success('yes!');
        }else{
            return $this->error('no!');
        }
         return;    
     }
    $this->assign('articles',$articles);
    $columns=db('column')->select();
    $this->assign('columns',$columns);
  
  

  
        return $this->fetch();
    }

   
}

