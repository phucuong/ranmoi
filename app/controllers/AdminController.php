<?php
class AdminController extends Zend_Controller_Action
{
	private $user_info = null;
	private $NUM_ROW = 7;
	
	public function init()
	{
		/*$arrInfo['user_id'] = 1;
		$arrInfo['fullname'] = 'admin';
		$arrInfo['email'] = 'admin@yahoo.com';*/
		$sessionService = new SessionService();
		$this->view->user_info = $this->user_info = $sessionService->getSession();
		if ( empty($this->user_info["user_id"]) ){
            header("Location: /login");
            exit();
        }
        $this->view->name = $this->user_info['fullname'];
		$this->view->time = UtilitiService::now();
	}
	
	
	public function homeAction(){
		
	}
	
	public function userAction(){
		$this->view->userInfo = $this->user_info;
	}
	
	public function changepassAction(){
		$this->_helper->viewRenderer->setNoRender();
		
		$request = $this->_request;
		$oldPass = trim($request->getParam('old_pass',''));
		$newPass = trim($request->getParam('new_pass',''));
		$reNewPass = trim($request->getParam('re_new_pass',''));
		$userId = $this->user_info['user_id'];
		$msg = '';
		$status = 0;
		if ($oldPass == '' || $newPass == '' || $reNewPass == ''){
			$msg = 'Các ô không được để trống!';
		}
		
		$user = new User();
		if($msg == ''){
			$passInfo = $user->getOldPass($userId);
			if (md5($oldPass) != $passInfo['password']){
				$msg = 'Password cũ không đúng!';
			}
		}
		
		if($msg == ''){
			if ($reNewPass !== $newPass){
				$msg = 'Password lặp lại không giống!';
			}
		}
		
		if($msg == ''){ 
			$newPass = md5($newPass);
			$updateData['password'] = $newPass;
			if (1 === $user->updateUser($userId, $updateData)){
				$msg = 'Cập nhật thành công!';
				$status = 1;
			}
			else{
				$msg = 'Cập nhật không thành công!';
			}
		}
		
		$response['msg'] = $msg;
		$response['status'] = $status;
		$json = UtilitiService::createJson($response);
		echo $json;
	}
	
	public function categoryAction(){
		$category = new Category();
		$listCategory = $category->getAllCategory();
		$categoryPosition = new CategoryPosition();
		foreach ($listCategory as $key=>$cat){
			$listPost = $categoryPosition->getPosFromCatId($cat['category_id']);
			$strPos = '';
			foreach ($listPost as $value) {
				$strPos .= $value['position_name'] . ', ';
			}
			$listCategory[$key]['str_pos'] = $strPos;
		}
		$this->view->categories = $listCategory;
		$this->view->msg = $this->_request->getParam('msg','');
	}
	
	public function addcategoryAction(){
		$request = $this->_request;
		if($request->isPost()){
			$cateName = trim($request->getParam('cat_name',''));
			$parentId = trim($request->getParam('lst_cat_parent',0));
			$hide= ($request->getParam('chk_hide',0) === 'on' ? 1 : 0);
			$topCheck = ($request->getParam('chk_top_menu',0) === 'on' ? 1 : 0);
			$midCheck = ($request->getParam('chk_mid_menu',0) === 'on' ? 1 : 0);
			$bottomCheck = ($request->getParam('chk_bottom_menu',0) === 'on' ? 1 : 0);
			$orderTop = intval(trim($request->getParam('order_top_menu',0)));
			$orderMid = intval(trim($request->getParam('order_mid_menu',0)));
			$orderBottom = intval(trim($request->getParam('order_bottom_menu',0)));
			$msg = '';
			if ($cateName == ''){
				$msg = 'Bạn chưa nhập tên danh mục!';
			}
			
			$insertData['category_name'] = $cateName;
			$insertData['category_name_no_sign'] = UtilitiService::changeTitle($cateName);
			$insertData['category_id_father'] = $parentId;
			$insertData['hide'] = intval($hide);
			
			if($msg == ''){
				$category = new Category();
				$cateId = $category->insertCategory($insertData);
				if($cateId > 0){
					$insertData = array();
					$insertData['category_id'] = $cateId;
					$categoryPosition = new CategoryPosition();
					if(1 === $topCheck){
						$insertData['order'] = $orderTop;
						$insertData['position_id'] = 1;
						$categoryPosition->insertCatPos($insertData);
					}
					if(1 === $midCheck){
						$insertData['order'] = $orderMid;
						$insertData['position_id'] = 2;
						$categoryPosition->insertCatPos($insertData);
					}
					if(1 === $bottomCheck){
						$insertData['order'] = $orderBottom;
						$insertData['position_id'] = 3;
						$categoryPosition->insertCatPos($insertData);
					}
					header('Location: /admin/category');
				}
				else{
					$msg = 'Thêm danh mục không thành công!';
				}
			}
			$this->view->msg = $msg;
		}
		$this->view->menu = $this->makeCategoryMenu(0);
	}
	
	public function makeCategoryMenu($parentId, $space="", $trees = array()){
		if(!$trees){
			$trees = array();
		}
		$category = new Category();
		$result = $category->getFatherCategory($parentId);
		foreach ($result as $cat){
			$trees[] = array('category_id'=>$cat['category_id'], 'category_name'=>$space.$cat['category_name']);
			$trees = $this->makeCategoryMenu($cat['category_id'], $space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $trees);
		}
		return $trees;
	}
	
	public function editcategoryAction(){
		$request = $this->_request;
		if($request->isPost()){
			$cateName = trim($request->getParam('cat_name',''));
			$parentId = trim($request->getParam('lst_cat_parent',0));
			$hide= ($request->getParam('chk_hide',0) === 'on' ? 1 : 0);
			$topCheck = ($request->getParam('chk_top_menu',0) === 'on' ? 1 : 0);
			$midCheck = ($request->getParam('chk_mid_menu',0) === 'on' ? 1 : 0);
			$bottomCheck = ($request->getParam('chk_bottom_menu',0) === 'on' ? 1 : 0);
			$orderTop = intval(trim($request->getParam('order_top_menu',0)));
			$orderMid = intval(trim($request->getParam('order_mid_menu',0)));
			$orderBottom = intval(trim($request->getParam('order_bottom_menu',0)));
			$catId = $request->getParam('cat_id',0);
			$msg = '';
			
			$category = new Category();
			$catInfo = $category->getCategory($catId);
			if(empty($catInfo)){
				header('Location: /admin/category');
				exit;
			}
			if ($cateName == ''){
				$msg = 'Bạn chưa nhập tên danh mục!';
			}
			if($catInfo['category_id'] == $parentId){
				$msg = 'Không thể làm danh mục con của chính mình!';
			}
			
			$insertData['category_name'] = $cateName;
			$insertData['category_name_no_sign'] = UtilitiService::changeTitle($cateName);
			$insertData['category_id_father'] = $parentId;
			$insertData['hide'] = intval($hide);
			$insertData['update_date'] = new Zend_Db_Expr('now()');
			
			if($msg == ''){
				$success = $category->updateCategory($insertData, $catId);
				if($success > 0){
					$insertData = array();
					$categoryPosition = new CategoryPosition();
					if(1 === $topCheck){
						$insertData['order'] = $orderTop;
						if(!$categoryPosition->isPosExist($catId, 1)){
							$insertData['category_id'] = $catId;
							$insertData['position_id'] = 1;
							$categoryPosition->insertCatPos($insertData);
						}
						else{
							$categoryPosition->updateCatPos($catId, 1, $insertData);
						}
					}
					else{
						$categoryPosition->deleteCatPos($catId, 1);
					}
					if(1 === $midCheck){
						$insertData['order'] = $orderMid;
						if(!$categoryPosition->isPosExist($catId, 2)){
							$insertData['category_id'] = $catId;
							$insertData['position_id'] = 2;
							$categoryPosition->insertCatPos($insertData);
						}
						else{
							$categoryPosition->updateCatPos($catId, 2, $insertData);
						}
					}
					else{
						$categoryPosition->deleteCatPos($catId, 2);
					}
					if(1 === $bottomCheck){
						$insertData['order'] = $orderBottom;
						if(!$categoryPosition->isPosExist($catId, 3)){
							$insertData['category_id'] = $catId;
							$insertData['position_id'] = 3;
							$categoryPosition->insertCatPos($insertData);
						}
						else{
							$categoryPosition->updateCatPos($catId, 3, $insertData);
						}
					}
					else{
						$categoryPosition->deleteCatPos($catId, 3);
					}
					header('Location: /admin/category');
				}
				else{
					$msg = 'Cập nhật danh mục không thành công!';
				}
			}
			$this->view->msg = $msg;
		}

		$catId = $request->getParam('catid',0);
		$category = new Category();
		if(empty($catInfo)){
			$catInfo = $category->getCategory($catId);
			if (empty($catInfo)){
				header('Location: /admin/category');
				exit;
			}
		}
		
		$categoryPosition = new CategoryPosition();
		$listPost = $categoryPosition->getPosFromCatId($catId);
		$catInfo['top_pos'] = 0;
		$catInfo['mid_pos'] = 0;
		$catInfo['bot_pos'] = 0;
		$catInfo['top_order'] = 0;
		$catInfo['mid_order'] = 0;
		$catInfo['bot_order'] = 0;
		foreach ($listPost as $pos){
			if($pos['position_id'] == 1){
				$catInfo['top_pos'] = 1;
				$catInfo['top_order'] = $pos['order'];
				continue;
			}
			if($pos['position_id'] == 2){
				$catInfo['mid_pos'] = 1;
				$catInfo['mid_order'] = $pos['order'];
				continue;
			}
			if($pos['position_id'] == 3){
				$catInfo['bot_pos'] = 1;
				$catInfo['bot_order'] = $pos['order'];
				continue;
			}
		}
		$this->view->cat = $catInfo;
		$this->view->menu = $this->makeCategoryMenu(0);
	}
	
	public function deletecategoryAction(){
		$request = $this->_request;
		$catId = $request->getParam('catid',0);
		$new = new News();
		$new->deleteNewsFromCatId($catId);
		$category = new Category();
		$category->deleteCategory($catId);
		header('Location: /admin/category');
	}
	
	public function newsAction(){
		$news = new News();
		$listNews = $news->getAllNews();
		$page = $this->_request->getParam('pageNum',1);
		$listNewsPaging = $news->getNewsLimit($page, $this->NUM_ROW);
		$numRow = count($listNews);
		$linkPaging = UtilitiService::pagesLinks($numRow,$page,$this->NUM_ROW);
		$this->view->link_paging = $linkPaging;
		$this->view->news = $listNewsPaging;
	}
	
	public function addnewsAction(){
		$request = $this->_request;
		if($request->isPost()){
			$title = trim($request->getParam('txt_title',''));
			$hide= ($request->getParam('chk_hide',0) === 'on' ? 1 : 0);
			$cateId = $request->getParam('cat',0);
			$content = $request->getParam('txt_content','');
			$desc = $request->getParam('txt_desc','');
			$msg = '';
			if(empty($_FILES['file'])){
				$msg = 'Bạn chưa chọn hình ảnh!';
			}
			
			if ($title == ''){
				$msg = 'Bạn chưa nhập tên bài viết!';
			}
			if($cateId == 0){
				$msg = 'Bạn chưa chọn danh mục!';
			}
			
			$news = new News();
			$titleNoSign = UtilitiService::changeTitle($title);
			if($msg == ''){
				if($news->isTitleExist($titleNoSign)){
					$msg = "Tên bài viết đã tồn tại!";
				}
			}
			
			$imageName = '';
			if($msg == ''){
				$file = $_FILES['file'];
				$imageName = ImageService::uploadImage($file,$imgError);
				if ($imgError == 2)
				{
					$msg = "File quá lớn!";
				}
				if ($imgError == 3)
				{
					$msg = "Không đúng định dạng file!";
				}
			}
			
			if($msg == ''){
				$insertData['title'] = $title;
				$insertData['title_no_sign'] = $titleNoSign;
				$insertData['hide'] = intval($hide);
				$insertData['category_id'] = $cateId;
				$insertData['description'] = $desc;
				$insertData['image_url'] = $imageName;
				$insertData['content'] = $content;
				$insertData['user_id'] = $this->user_info['user_id'];
				$newsId = $news->insertNews($insertData);
				if($newsId > 0){
					header('Location: /admin/news');
				}
				else{
					$msg = 'Thêm bài viết không thành công!';
				}
			}
			$this->view->msg = $msg;
		}
		$cat = new Category();
		//$this->view->cats = $cat->getAllCategory();
		$this->view->cats = $this->makeCategoryMenu(0);
	}
	
	public function editnewsAction(){
		$request = $this->_request;
		if($request->isPost()){
			$newsId = $request->getParam('news_id',0);
			$title = trim($request->getParam('txt_title',''));
			$hide= ($request->getParam('chk_hide',0) === 'on' ? 1 : 0);
			$cateId = $request->getParam('cat',0);
			$content = $request->getParam('txt_content','');
			$desc = $request->getParam('txt_desc','');
			
			$msg = '';
			if ($title == ''){
				$msg = 'Bạn chưa nhập tên bài viết!';
			}
			if($cateId == 0){
				$msg = 'Bạn chưa chọn danh mục!';
			}
			
			$newsInfo = $_SESSION['news'];
			$imageName = $newsInfo['image_url'];
			
			if ($newsId != $newsInfo['news_id']){
				header('Location: /admin/news');exit;
			}
			
			$news = new News();
			$titleNoSign = UtilitiService::changeTitle($title);
			if($msg == '' && $titleNoSign != $newsInfo['title_no_sign']){
				if($news->isTitleExist($titleNoSign)){
					$msg = "Tên bài viết đã tồn tại!";
				}
			}
			
			if($msg == '' && !empty($_FILES['file']['tmp_name'])){
				$file = $_FILES['file'];
				$imageName = ImageService::uploadImage($file,$imgError);
				if ($imgError == 2)
				{
					$msg = "File quá lớn!";
				}
				if ($imgError == 3)
				{
					$msg = "Không đúng định dạng file!";
				}
			}
			
			if($msg == ''){
				$insertData['title'] = $title;
				$insertData['title_no_sign'] = $titleNoSign;
				$insertData['hide'] = intval($hide);
				$insertData['category_id'] = $cateId;
				$insertData['description'] = $desc;
				$insertData['image_url'] = $imageName;
				$insertData['content'] = $content;
				$insertData['user_id'] = $this->user_info['user_id'];
				$insertData['update_date'] = new Zend_Db_Expr('now()');
				$success = $news->updateNews($newsId, $insertData);
				if($success > 0){
					header('Location: /admin/news');
				}
				else{
					$msg = 'Cập nhật bài viết không thành công!';
				}
			}
			$this->view->msg = $msg;
		}
		$cat = new Category();
		$this->view->cats = $cat->getAllCategory();
		$newsId = $request->getParam('newsid');
		$news = new News();
		$newsInfo = $news->getNews($newsId);
		if(empty($newsInfo)){
			header('Location: /admin/category');
			exit;
		}
		$_SESSION['news'] = $newsInfo;
		$this->view->news_info = $newsInfo;
		$this->view->cats = $this->makeCategoryMenu(0);
	}
	
	public function deletenewsAction(){
		$request = $this->_request;
		$newsId = $request->getParam('newsid',0);
		$new = new News();
		$new->deleteNews($newsId);
		header('Location: /admin/news');
	}
	
	public function photoAction(){
		$photo = new Photo();
		$photos = $photo->getAllPhoto();
		$this->view->photos = $photos;
	}
	
	public function addphotoAction(){
		$request = $this->_request;
		if($request->isPost()){
			$order = trim($request->getParam('txt_order',0));
			if(empty($_FILES['file'])){
				$msg = 'Bạn chưa chọn hình ảnh!';
			}
			
			$msg = '';
			
			$imageName = '';
			if($msg == ''){
				$file = $_FILES['file'];
				$imageName = ImageService::uploadPhoto($file,$imgError);
				if ($imgError == 2)
				{
					$msg = "File quá lớn!";
				}
				if ($imgError == 3)
				{
					$msg = "Không đúng định dạng file!";
				}
				if ($imgError == 4){
					$msg = "Xảy ra lỗi khi upload file!";
				}
			}
			
			if($msg == ''){
				$insertData['order'] = $order;
				$insertData['photo_url'] = $imageName;
				$photo = new Photo();
				$photoId = $photo->insertPhoto($insertData);
				if($photoId > 0){
					header('Location: /admin/photo');
				}
				else{
					$msg = 'Thêm hình ảnh không thành công!';
				}
			}
			$this->view->msg = $msg;
		}
	}
	
	public function deletephotoAction(){
		$request = $this->_request;
		$photoId = $request->getParam('photoid',0);
		$photo = new Photo();
		
		$photoInfo = $photo->getPhoto($photoId);
			if(!empty($photoInfo)){
			$config = Zend_Registry::get('config');
			$linkFolder = dirname(__FILE__) . '/../../html';
			if (file_exists($linkFolder.$config->web_url->photo_org.'/'.$photoInfo['photo_url']))
			{
				@unlink($linkFolder.$config->web_url->photo_org.'/'.$photoInfo['photo_url']);
			}
			if (file_exists($linkFolder.$config->web_url->photo_138.'/'.$photoInfo['photo_url']))
			{
				@unlink($linkFolder.$config->web_url->photo_138.'/'.$photoInfo['photo_url']);
			}
			$photo->deletePhoto($photoId);
		}
		header('Location: /admin/photo');
	}
}
?>
