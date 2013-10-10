<?php
	class IndexController extends Zend_Controller_Action
	{
		
		public function init()
		{
			
		}
		public function indexAction()
		{
			$category = new Category();
			$catBotLv1 = $category->getCateLever1(3);
			$this->view->bot_cats = $catBotLv1;
			$catMid = $category->getCateLever1(2);
			$news = new News();
			foreach ($catMid as $key=>$val){
				$catMid[$key]['news'] = $news->getNewsTitleFromCat($val['category_id']);
			}
			$this->view->mid_cats = $catMid;
			$photo = new Photo();
			$this->view->photos = $photo->getAllPhoto();
			$this->view->news =$news->getNewsTitleFromCat(23);
		}
		
		public function categoryAction(){
			$catName = $this->_request->getParam('cat','');
			$category = new Category();
			$catBotLv1 = $category->getCateLever1(3);
			$this->view->bot_cats = $catBotLv1;
			$news = new News();
			$this->view->news =$news->getNewsTitleFromCat(23);
			$this->view->cats = $news->getNewsFromCatName($catName);
		}
		
		public function newsAction(){
			$newName = $this->_request->getParam('news_name','');
			$category = new Category();
			$catBotLv1 = $category->getCateLever1(3);
			$this->view->bot_cats = $catBotLv1;
			$news = new News();
			$this->view->news =$news->getNewsTitleFromCat(23);
			$this->view->news_detail = $news->getNewDetail($newName);
		}
		
		public function contactAction(){
			$msg = '';
			if($this->_request->isPost()){
				$subject = trim($this->_request->getParam('subject',''));
				$name = $this->_request->getParam('name','');
				$email = $this->_request->getParam('email','');
				$mobile = $this->_request->getParam('mobile','');
				$address = $this->_request->getParam('address','');
				$txtContent = $this->_request->getParam('txtContent','');
				if($subject == '' || $name == '' || $email == '' || $txtContent == ''){
					$msg = 'Yêu cầu nhập chủ đề, tên, email và nội dung!';
				}
				if($msg == '' && !filter_var($email, FILTER_VALIDATE_EMAIL)){
					$msg = 'Email không đúng định dạng!';
				}
				if($msg == ''){
		            $assign_array   = array("subject"=>$subject
		                                   ,"name"=> $name,
		                                   'mobile'=>$mobile,
		                                   'address'=>$address,
		                                   'content'=>$txtContent,
		                                   'email'=>$email,
		                                   );
		            require( dirname(__FILE__)."/../mail/contact.php" );
		            MailService::sendEmail($body, $name);
		            $msg = 'Gửi thông tin thành công!';
				}
			}
			$newName = $this->_request->getParam('news_name','');
			$category = new Category();
			$catBotLv1 = $category->getCateLever1(3);
			$this->view->bot_cats = $catBotLv1;
			$news = new News();
			$photo = new Photo();
			$this->view->photos = $photo->getAllPhoto();
			$this->view->news =$news->getNewsTitleFromCat(23);
			$this->view->msg = $msg;
		}
	}
?>
