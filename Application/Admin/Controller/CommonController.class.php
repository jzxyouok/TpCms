<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
        if(null == session('user')){
            $this->redirect('/admin/auth/login');
        }
        $uid = session('user')['id'];
        $this->assign('online_user',D('User')->find($uid));
    }
}