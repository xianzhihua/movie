<?php
namespace app\index\validate;
use think\Validate;
class Index extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:25|unique:user',
        'password' =>  'require',
        'name' =>  'require',
    ];

    protected $message  =   [
        'username.unique' => '账号不得重复',
        'password.require' => '密码必须填写',
        'name.require' => '昵称必须填写',

    ];

    protected $scene = [
        'register'  =>  ['username'=>'require|unique:user','password','name'],
    ];




}
