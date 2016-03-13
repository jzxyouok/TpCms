<?php
namespace Admin\Controller;

class SingleController extends CommonController
{
    /**
     * 个人信息
     */
    public function info()
    {
        if(IS_POST && !IS_AJAX){
            $detail_data = [
                'real_name' => I('post.real_name',''),
                'gender' => (int)I('post.gender',''),
                'age' => (int)I('post.age',''),
                'qq' => I('post.qq',''),
                'wechat' => I('post.wechat',''),
                'note' => I('post.note',''),
            ];

            $detail = D('UserDetail');
            $detail_data = $detail->create($detail_data);

            $uid = session('user')['id'];
            if($detail_data && $detail->where(['user_id' => $uid])->save($detail_data)){
                $this->success('操作完成','/admin/single/info',1);
            }else{
                $this->error('操作失败'.$detail->getError());
            }
        }else{
            $single = D('UserDetail')->relation('user')->find(session('user')['id']);

            $this->assign('single',$single);

            $this->assign('nav',[
                'title' => '个人信息'
            ]);
            $this->assign('breadcrumbs',[
                '个人信息' => '',
            ]);
            $this->display();
        }
    }

    /**
     * 修改用户密码
     */
    public function password_update()
    {
        if(IS_POST && !IS_AJAX){
            $input['old_password'] = I('param.old_password');
            $input['password'] = I('param.password');
            $input['confirm_password'] = I('param.confirm_password');

            $user = D('User');

            $condition = [
                'id' => session('user')['id'],
                'password' => sha1($input['old_password']),
            ];

            if(!$user->where($condition)->count()){
                $this->error('原密码出错');
            }

            $password = $user->create($input);

            $uid = $condition['id'];
            if($password && $user->where(['id' => $uid])->save($password)){
                $this->success('操作完成','/admin/single/password_update',1);
            }else{
                $this->error('操作失败'.$user->getError());
            }
        }else{
            $this->assign('nav',[
                'title' => '个人密码修改'
            ]);
            $this->assign('breadcrumbs',[
                '个人密码修改' => '',
            ]);
            $this->display();
        }
    }

    public function store_avatar()
    {
        $path = I('post.path');

        $user = D('User');

        $uid = session('user')['id'];

        $sql = "update cms_user set avatar='".$path."' where id=".$uid;

        if($user->execute($sql)){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '保存成功',
            ]);
        }else{
            $this->ajaxReturn([
                'state' => 0,
                'message' => '保存失败或重复保存',
            ]);
        }
    }

}