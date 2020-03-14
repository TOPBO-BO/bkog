<?php
namespace app\admin\Validate;
use think\Validate;
class Admin extends Validate
{
    protected $rule = [
        'username'  =>  'require|min:3',
        'password' =>  'require',
    ];
       protected $message  =   [
        'username.require' => '名称重复或者没有更改',
        'username.min'     => '名称最多不能超过3个字符',
        'password.require' => '密码必须',
        
    ];
       protected $scene = [
        'admin_add' =>['username'=>'required','password'],
        'admin_edit' =>['username'=>'required',]
    ];
   
}

