<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

    protected $_validate = [
        ['username','require','用户名必填'],
        ['username','','用户名已经存在',0,'unique',3],
        ['email','require','邮箱必填'],
        ['email','','邮箱已经存在',0,'unique',3],
        ['email','email','请使用邮箱格式'],
        ['mobile','require','手机号必填'],
        ['mobile','','手机号已经存在',0,'unique',3],
        ['mobile','/^1[3|5|8][0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','手机号码格式不对',0,'regex'],
        ['password','require','密码必填'],
        ['password','8,12','密码长度必须8-12字符',0,'length'],
        ['confirm_password','password','确认密码和密码不一致',0,'confirm'],
    ];

    protected $_auto = [
        ['password','autoPassword',3,'callback'],
        ['created_at','time',2,'function'],
        ['updated_at','time',1,'function'],
    ];

    protected function autoPassword($password)
    {
        if($password){
            return sha1($password);
        }

        return $this->password;
    }

    // 插入数据前的回调方法
    protected function _before_insert(&$data, $options)
    {
        $this->startTrans();
    }
    // 插入成功后的回调方法
    protected function _after_insert($data, $options)
    {
        $uid = $data['id'];
        $detail = D('UserDetail');
        $detail_data = [
            'user_id' => $uid,
        ];
        $detail_data = $detail->create($detail_data);
        if($detail_data && $detail->add($detail_data)){
            $this->commit();
        }else{
            $this->rollback();
            throw new \Exception('操作失败');
        }
    }
}
