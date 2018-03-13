<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController
{
    protected $Gateway;
    protected $Address;

    public function _initialize()
    {
        parent::_initialize();
        $this->Gateway                  = new \Gateway();
        $this->Gateway->registerAddress = '127.0.0.1:1236';

    }

    public function login()
    {
        if (IS_POST) {
            $username = I("post.username", '', 'trim');
            $password = I("post.password", '', 'trim');
            if ($password == "" || $username == "") {
                $this->error("用户名或密码错误！");
            }
            $password  = md5($password);
            $map       = array('user' => $username, "pwd" => $password);
            $adminUser = M("member")->where($map)->find();
            if (count($adminUser) > 0) {
                \User::initUserData($adminUser);
                $this->success("登录成功！", "index");
            } else {
                $this->error("登录失败！");
            }
        } else {
            if (session('userinfo')) {
                $this->redirect("Index/index");
                exit();
            }
            $this->display('Index/login');
        }

    }

    public function index()
    {
        $user = M('member')->select();
        $uid  = $user['user'];
        $this->assign('user', $user);
        $this->assign('index_active', 'aui-active');
        $this->display();

    }

    public function get_upid()
    {
        $ip  = getIp();
        $arr = explode('.', $ip);
        array_pop($arr);
        $upid = implode('.', $arr);
        return $upid;
    }

    public function bind()
    {
        $this->Gateway->registerAddress = '127.0.0.1:1236';
        $client_id                      = I('post.client_id');
        $send_user                      = $this->userObject->getUserInfo();
        $uid                            = $send_user['user'];
        $this->Gateway->bindUid($client_id, $uid);

    }

    public function send_message()
    {
        $this->Gateway->registerAddress = '127.0.0.1:1236';
        $send_user                      = $this->userObject->getUserInfo();
        $uid                            = I('post.uid');
        echo $uid;
        $message  = I('post.msg');
        $req_data = json_encode(
            array(
                'sendUserImg'  => $send_user['img'],
                'sendUserName' => $send_user['user'],
                'sendUserMsg'  => $message,
            ));
        $this->Gateway->sendToUid($uid, $req_data);

    }

    public function save_offline_message($message)
    {
        //$res=M('offline')->add($message);

    }

}
