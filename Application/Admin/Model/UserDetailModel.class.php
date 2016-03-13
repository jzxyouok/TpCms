<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class UserDetailModel extends RelationModel {

    protected $_link = [
        'user'=>[
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'User',
            'mapping_name'      => 'user',
            'foreign_key'       => 'id',
        ],
    ];

    protected $_validate = [
        //['real_name','checkRealName','真实姓名必须中文',0,'callback'],
        ['real_name','2,4','真实姓名必须2-4字符',0,'length'],
        ['age','/^[0-9]+$/','年龄必须为整数',0,'regex'],
        ['qq','/^[0-9]+$/','QQ必须为整数',0,'regex'],
        ['email','email','请使用邮箱格式'],
        ['mobile','/^1[3|5|8][0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','手机号码格式不对',0,'regex'],
    ];

    protected function checkRealName($real_name)
    {
        return preg_match('/^[u4e00-u9fa5]+$/',$real_name);
    }

    protected $_auto = [
        ['created_at','time',2,'function'],
        ['updated_at','time',1,'function'],
    ];
}
