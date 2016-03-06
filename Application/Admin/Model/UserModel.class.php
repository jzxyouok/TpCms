<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

    //protected $_prefix = 'cms_';

    protected $_validate = [
        ['username','require','用户名必填'],
        ['email','require','邮箱必填'],
        ['email','email','请使用邮箱格式'],
        ['mobile','require','手机必填'],
        ['mobile','/^1[3|5|8][0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','手机号码格式不对',0,'regex'],
        ['password','require','密码必填'],
        ['password','8,12','密码长度必须8-12字符',0,'length'],
        ['confirm_password','password','确认密码和密码不一致',0,'confirm'],
    ];

    protected $_auto = [
        ['password','sha1',3,'function'],
        ['created_at','time',1,'function'],
        ['updated_at','time',2,'function'],
    ];
}
