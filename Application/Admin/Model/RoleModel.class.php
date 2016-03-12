<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model {

    protected $_validate = [
        ['name','require','角色名称必填'],
        ['name','2,6','角色名称长度必须2-6字符',0,'length'],
        ['description','0,200','角色描述长度必须2-6字符',0,'length'],
    ];

    protected $_auto = [
        ['created_at','time',1,'function'],
        ['updated_at','time',2,'function'],
    ];
}
