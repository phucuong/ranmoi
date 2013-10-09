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
	}
?>
