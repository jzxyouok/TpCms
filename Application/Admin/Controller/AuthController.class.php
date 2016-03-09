<?php
namespace Admin\Controller;

use Think\Controller;

class AuthController extends Controller
{
    public function validate()
    {
        return validateCode($width=80,$height=30,$font_size =20);
    }

    public function login()
    {
        $cookie_user = cookie('user');

        if(session('?user')){
                $this->redirect('/admin');
            }elseif(isset($cookie_user)){
                session('user' , $cookie_user);
                $this->redirect('/admin');
        }
        if(IS_POST){
            $username = trim(I('param.username'));
            $password = trim(I('param.password'));
            $validateCode = trim(I('param.validateCode'));
            $remember = (bool)I('param.remember');
            $user = D('User');
            if(!$user->where(['username' => $username])->count()){
                $this->error('登录失败,用户不存在!');
            }

            if(!$user->where(['username' => $username , 'password' => sha1($password)])->count()){
                $this->error('用户名或密码错误!');
            }

            if(strtoupper($validateCode) !== strtoupper(session('validateCode'))){
                $this->error('验证码错误!');
            }

            $data = $user->field([
                'username',
                'email',
                'mobile',
                'avatar',
            ])->where(['username' => $username , 'password' => sha1($password)])->find();

            if($remember){
               cookie('user',$data,['expire' =>3600*24*3,'prefix' => 'think_' ]);
            }

            session('user',$data);

            $this->redirect('/admin');
        }else{
            C('LAYOUT_ON',false);
            $this->display();
        }
    }

    public function logout()
    {
        cookie('user',null);
        if(session('?user')){
            session('user',null);
            $this->redirect('/admin');
        }
    }
}