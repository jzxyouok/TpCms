<?php
namespace Admin\Controller;

class UserController extends CommonController
{
    /**
     * 用户列表
     */
    public function index()
    {
        $keyword = I('param.keyword','');

        $user = D('User');

        $where['id']  = array('like', "%$keyword%");
        $where['username']  = array('like',"%$keyword%");
        $where['_logic'] = 'or';
        $map['_complex'] = $where;

        $page_size = 10;

        $count = $user->count();

        $pagination = new \Think\Page($count,$page_size);

        $data = $user->where($map)->field([
            'id',
            'username',
            'email',
            'mobile',
            'avatar',
            'type',
            'status',
            'login',
            'last_login_time',
            'last_login_ip',
            'created_at',
        ])->limit($pagination->firstRow , $pagination->listRows)->select();

        $this->assign('user',$data);
        //分页跳转的时候保证查询条件
        foreach($map as $key=>$val) {
            $pagination->parameter[$key] = urlencode($val);
        }
        $this->assign('pagination',$pagination);

        $this->assign('keyword',$keyword);

        $this->assign('nav',[
            'title' => '管理员列表'
        ]);
        $this->assign('breadcrumbs',[
            '管理员列表' => '',
        ]);

        $this->display();
    }

    /**
     * 创建用户
     */
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
                $this->success('操作完成','/admin/user',1);
            }else{
                $this->error('操作失败'.$user->getError());
            }
        }else{
            $this->assign('nav',[
                'title' => '管理员创建'
            ]);
            $this->assign('breadcrumbs',[
                '管理员列表' => U('/admin/user'),
                '管理员创建' => '',
            ]);
            $this->display('save');
        }
    }

    /**
     * 更新用户名
     * @param $id
     */
    public function update($id)
    {
        if(IS_POST && !IS_AJAX){
            $data['email'] = I('param.email');
            $data['mobile'] = I('param.mobile');
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
            $user = D('User')->find($id);
            $this->assign('user',$user);
            $this->assign('nav',[
                'title' => '修改管理员'
            ]);
            $this->assign('breadcrumbs',[
                '管理员列表' => U('/admin/user'),
                '修改管理员' => '',
            ]);
            $this->display();
        }
    }

    /**
     * 删除用户
     * @param $id
     */
    public function delete($id)
    {
        if(IS_AJAX){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '删除成功',
            ]);
        }
    }

    /**
     * 用户禁用与启用
     * @param $id
     */
    public function disable($id)
    {
        $user = D('User');

        $data = $user->find($id);

        $user->status = $data['status'] ? 0 : 1;

        if($user->save()){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '操作成功',
            ]);
        }
    }

    public function allot($id)
    {
        echo __METHOD__;exit;
    }
}