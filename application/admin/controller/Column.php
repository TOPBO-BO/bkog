<?php
namespace app\admin\controller;
use app\admin\controller\Comm;

// use think\Db;
use app\admin\model\Column as ColumnModel;
class Column extends Comm
{
    public function column_add()
    {
        if(request()->isPost()) {
            // dump(input('post.'));
            $data=[
                'column'=>input('column'),
                
            ];
            $validate = \think\Loader::validate('Column');
            if(!$validate->check($data)){
              $this->error($validate->getError());
             die;
            }           
            if(db('column')->insert($data)) {
                return $this->success('成功!','column_list');
            }else{
                return $this->error('失败!');
            }
         return;
    }
        return $this->fetch();
    }

       public function column_list() 
    {
        $list =ColumnModel::paginate(5);
        $this->assign('list',$list);
        return $this->fetch();
    }

       public function column_edit(){
          $id=input('id');
          $columns=db('column')->find($id);
        if (request()->isPost()) {
              $data=[
            'id'=>input('id'),
            'column'=>input('column'),
            // 'password'=>input('newpassword'),
        ];

        // if(input('password')){
        //     $data['password']=input('password');
        //    }else{
        //     $data['password']=$columns['password'];
        //    }
        //    if ($data['password']!=$columns['password']) {
        //        return $this->error(密码no);
        //    }die;
        if (db('column')->update($data)) {
            return $this->success('yes!');
        }else{
            return $this->error('no!');
        }

        return;
    } 
       $this->assign('columns',$columns);
        return $this->fetch();
    }

public function column_password_edit(){

   
    // 提交信息
          $id=input('id');
          $columns=db('column')->find($id); // 看到了吗  只是通过id查询就好了
         if (request()->isPost()) {// post提交
            $data = request()->param();
            if ($columns['password'] != $data['oldpassword']) { //为什么没有变量
                // 不是ajax提交 就用error返回
                $this->error('旧密码错误',url('column_list'));// 这个忘记了怎么写了 ok？看明白吗
            }
            // 比较就是  如果相同  再比较新密码和旧密码是否相等
            if ($data['oldpassword'] == $data['newpassword']) { // 这里判断对了吗
                $this->error('新旧密码相同',url('column_list'));// 这个忘记了怎么写了 ok？看明白吗
            }
            // 这里就是数据入库了 修改值
            $res=db('column')->where('id',$data['id'])->setField('password',$data['newpassword']);
            if ($res) {
                $this->success('修改成功',url('column_list'));// 这个忘记了怎么写了 ok？看明白吗
            }else{
                $this->error('修改失败',url('column_list'));
            }

            // 看明白了吗
            
         }
         // 分配信息过去
         //密码其实不需要显示的  修改用户密码 是不需要知道他的密码  只要重置  对吧
         $this->assign('columns',$columns);
        return $this->fetch();
    } 
      
     public function column_del()
    {
        $id=input('id');
        $del=db('column')->delete(input('id'));
        if($del){
            $this->success('ok');
        }else{
            $this->error('no');
        }
        //不可以修改初管理员
        // if ($id!=1) {
        //     if ($del) {
        //        $this->success('删除成功！','column_list');
        //     }else{
        //         $this->error('删除失败！');
        //     }else{
        //         $this->error('不可以删除！');
        //     }
        // }
        return $this->fetch();
    }   
    public function article_list()
    {
        return $this->fetch();
    }

     public function member_add()
    {
        return $this->fetch();
    }

    public function article_add()
    {
        return $this->fetch();
    }

    public function picture_list()
    {
        return $this->fetch();
    }

     public function column_role()
    {
        return $this->fetch();
    }

     public function  column_role_add()
    {
        return $this->fetch();
    }
 
      public function login()
    {

        return $this->fetch();
    }

   
}

