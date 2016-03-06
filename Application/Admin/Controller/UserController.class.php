<?php
namespace Admin\Controller;

class UserController extends CommonController
{
    public function index()
    {
        $user = D('User');

        $page_size = 4;

        $count = $user->count();

        $pagination = new \Think\Page($count,$page_size);

        $data = $user->field([
            'id',
            'username',
            'email',
            'mobile',
            'avatar',
            'type',
            'last_login_time',
            'last_login_ip',
            'created_at',
        ])->limit($pagination->firstRow , $pagination->listRows)->select();

        $this->assign('user',$data);

        $this->assign('pagination',$pagination);

        $this->assign('nav',[
            'title' => '用户列表'
        ]);
        $this->assign('breadcrumbs',[
            '用户列表' => '',
        ]);

        $this->display();
    }

    public function create()
    {
        if(IS_POST && !IS_AJAX){
            $data['username'] = I('param.username');
            $data['email'] = I('param.email');
            $data['mobile'] = I('param.mobile');
            $data['password'] = I('param.password');
            $data['confirm_password'] = I('param.confirm_password');
            $data['type'] = 1;

            $user = D('User');

            $data = $user->create($data);

            if($data && $user->add($data)){
                $this->success('操作完成','/admin/user',3);
            }else{
                $this->error('操作失败'.$user->getError());
            }
        }else{
            $this->assign('nav',[
                'title' => '用户创建'
            ]);
            $this->assign('breadcrumbs',[
                '用户列表' => U('/admin/user'),
                '用户创建' => '',
            ]);
            $this->display('save');
        }

    }

    public function update($id)
    {
        if(IS_POST && !IS_AJAX){
            $data['password'] = I('param.password');
            $data['confirm_password'] = I('param.confirm_password');

            $user = D('User');

            $data = $user->create($data);

            if($data && $user->where(['id' => $id])->count() && $user->where(['id' => $id])->save($data)){
                $this->success('操作完成','/admin/user',3);
            }else{
                $this->error('操作失败'.$user->getError());
            }
        }else{
            $this->assign('nav',[
                'title' => '修改用户密码'
            ]);
            $this->assign('breadcrumbs',[
                '用户列表' => U('/admin/user'),
                '修改用户密码' => '',
            ]);
            $this->display();
        }
    }

    public function delete($id)
    {
        if(IS_AJAX){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '删除成功',
            ]);
        }
    }
}