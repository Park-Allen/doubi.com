<?php
class User{

	private $UserData;

	function __construct(){
		$this->UserData=session('user');
	}

	static public function initUserData($userInfo){
		session('user',$userInfo);
	}

	public function getUserInfo(){
		return session('user');
	}

	public function getUerId(){
		$user=$this->getUserInfo();
		return $user['id'];
	}

	public function getUserName(){
		$user=$this->getUserInfo();
		return $user['uesr'];
	}

}