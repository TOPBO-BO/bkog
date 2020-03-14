<?php
namespace app\admin\controller;
use app\admin\controller\Comm;
use app\admin\model\Admin as AdminModel;
class Admin extends Comm
{
    public function admin_add()
    {
        if(request()->isPost()) {
            // dump(input('post.'));
            $data=[
                'username'=>input('username'),
                'password'=>input('password'),
            ];
            $validate = \think\Loader::validate('Admin');
            if(!$validate->check($data)){
              $this->error($validate->getError());
             die;
            }           
            if(db('admin')->insert($data)) {
                return $this->success('成功!','admin_list');
            }else{
                return $this->error('失败!');
            }
         return;
    }
        return $this->fetch();
    }

       public function admin_list()
    {
        $list =AdminModel::paginate(5);
        $this->assign('list',$list);
        return $this->fetch();
    }

       public function admin_edit(){
          $id=input('id');
          $admins=db('admin')->find($id);
        if (request()->isPost()) {
              $data=[
            'id'=>input('id'),
            'username'=>input('username'),
            // 'password'=>input('newpassword'),
        ];

        // if(input('password')){
        //     $data['password']=input('password');
        //    }else{
        //     $data['password']=$admins['password'];
        //    }
        //    if ($data['password']!=$admins['password']) {
        //        return $this->error(密码no);
        //    }die;
        if (db('admin')->update($data)) {
            return $this->success('yes!');
        }else{
            return $this->error('no!');
        }

        return;
    } 
       $this->assign('admins',$admins);
        return $this->fetch();
    }

public function admin_password_edit(){

   
    // 提交信息
          $id=input('id');
          $admins=db('admin')->find($id); // 看到了吗  只是通过id查询就好了
         if (request()->isPost()) {// post提交
            $data = request()->param();
            if ($admins['password'] != $data['oldpassword']) { //为什么没有变量
                // 不是ajax提交 就用error返回
                $this->error('旧密码错误',url('admin_list'));// 这个忘记了怎么写了 ok？看明白吗
            }
            // 比较就是  如果相同  再比较新密码和旧密码是否相等
            if ($data['oldpassword'] == $data['newpassword']) { // 这里判断对了吗
                $this->error('新旧密码相同',url('admin_list'));// 这个忘记了怎么写了 ok？看明白吗
            }
            // 这里就是数据入库了 修改值
            $res=db('admin')->where('id',$data['id'])->setField('password',$data['newpassword']);
            if ($res) {
                $this->success('修改成功',url('admin_list'));// 这个忘记了怎么写了 ok？看明白吗
            }else{
                $this->error('修改失败',url('admin_list'));
            }

            // 看明白了吗
            
         }
         // 分配信息过去
         //密码其实不需要显示的  修改用户密码 是不需要知道他的密码  只要重置  对吧
         $this->assign('admins',$admins);
        return $this->fetch();
    } 
      
     public function admin_del()
    {
        $id=input('id');
        $del=db('admin')->delete(input('id'));
        if($del){
            $this->success('ok');
        }else{
            $this->error('no');
        }
        //不可以修改初管理员
        // if ($id!=1) {
        //     if ($del) {
        //        $this->success('删除成功！','admin_list');
        //     }else{
        //         $this->error('删除失败！');
        //     }else{
        //         $this->error('不可以删除！');
        //     }
        // }
        return $this->fetch();
    }   
    
      public function log()
    {
       session(null);
       $this->success('拜拜','login/index');
    }
   
      public function login(){
        return $this->fetch();
      }
   
}

