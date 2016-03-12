<?php
namespace Admin\Controller;

use Think\Controller;

class AuthController extends Controller
{
    /**
     * 生成验证码
     */
    public function validate()
    {
        $verify = new \Think\Verify();
        $verify->fontttf = 'Roboto Mono.ttf';
        return $verify->entry();
    }

    /**
     * 用户登录
     */
    public function login()
    {
        $cookie_user = cookie('user');

        if(session('?user'))
        {
            $this->redirect('/admin');
        }
        elseif(isset($cookie_user))
        {
            session('user' , $cookie_user);
            $this->redirect('/admin');
        }

        if(IS_POST){
            $username = trim(I('param.username'));
            $password = trim(I('param.password'));
            $verify_code = trim(I('param.verify_code'));
            $remember = (bool)I('param.remember');
            $user = D('User');
            if(!$user->where(['username' => $username])->count()){
                $this->error('登录失败,用户不存在!');
            }

            if(!$data = $user->where(['username' => $username , 'password' => sha1($password)])->find()){
                $this->error('用户名或密码错误!');
            }

            if($data['status'] != 1){
                $this->error('用户已被禁用!');
            }

            if(!check_verify($verify_code)){
                $this->error('验证码错误!');
            }
            $data = array_except($data , ['password']);

            if($remember){
               cookie('user',$data,['expire' =>3600*24*3,'prefix' => 'think_' ]);
            }

            session('user',$data);

            $touch = [
                'login' => (int)++$data['login'],
                'last_login_time' => (int)time(),
                'last_login_ip' => (int)ip2long(get_client_ip()),
            ];

            M('User')->where(['id' => $data['id']])->save($touch);

            $this->redirect('/admin');
        }else{
            C('LAYOUT_ON',false);
            $this->display();
        }
    }

    /**
     * 用户退出
     */
    public function logout()
    {
        cookie('user',null);
        if(session('?user')){
            session('user',null);
            $this->redirect('/admin');
        }
    }
}