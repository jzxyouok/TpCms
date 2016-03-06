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
    }
}