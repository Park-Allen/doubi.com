<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    protected $userData;
    protected $userObject;

    function _initialize(){
   		vendor('Gateway.Gateway');
        vendor('User.User');
        $this->Gateway = new \Gateway();
        $this->checkLogin();
        $this->userObject = new \User();
    }

    protected function checkLogin(){
        $acl = array('login','verifyimg', 'check_verify'); //不需要登录的页面写进去
        if(!in_array(strtolower(ACTION_NAME), $acl)){
            if(!session('user')){
                $this->redirect('Index/login');
            }
        }
    }
 
}