<?php
namespace app\admin\controller;
use think\Controller;
class Comm extends Controller
{
    public function _initialize()
    {
        if(!session('username')) {
            $this->error('登陆试试','Login/index');
           
      }
   
}
}

