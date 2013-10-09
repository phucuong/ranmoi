<?php
class AuthController extends Zend_Controller_Action
{
	public function init()
	{
		
	}

	public function loginAction(){
		$request = $this->_request;
		if($request->isPost()){
			$email = trim($request->getParam('email',''));
			$password = trim($request->getParam('password',''));
			if ($email === '' || $password === ''){
				header('Location:/login');
			}
			$user = new User();
			$userInfo = $user->login($email, md5($password));
			if (!empty($userInfo)){
				$sessionService = new SessionService();
				$sessionService->setSession($userInfo);
				header('Location:/admin');
			}
		}
	}
	
	public function logoutAction(){
		$sessionService = new SessionService();
		$sessionService->clearSession();
		header('Location: /');
	}

}
?>
