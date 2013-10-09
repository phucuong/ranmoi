<?php
	$category = new Category();
	$catTopLv1 = $category->getCateLever1(1);
	$news = new News();
	echo '<ul>';
	echo '<li><a href="/" title="Rắn mối anh Hiển">Trang chủ</a></li>';
	foreach ($catTopLv1 as $cat){
		echo "<li style='z-index: 100;'><a href='/{$cat['category_name_no_sign']}' title='{$cat['category_name']}' class='' style='padding-right: 23px;'>{$cat['category_name']}<img src='/common/images/down.gif' class='downarrowclass' style='border:0;'></a>";
		getSubcategory($cat['category_id']);
		echo '</li>';
	}
	echo '<li><a href="/lien-he.html" title="Liên hệ">Liên hệ</a></li>';
	echo '</ul>';
	
	function getSubcategory($parentId){
        $category = new Category();
		$result = $category->getVisibleFatherCategory($parentId);
		$news = new News();
		//$lstNews = $news->getNewsTitleFromCat($parentId);
		echo '<ul style="display: none; top: 38px; visibility: visible;">';
		foreach ($result as $cat){
			echo "<li style='z-index: 100;'><a href='/{$cat['category_name_no_sign']}' title='{$cat['category_name']}'  class='' style='padding-right: 23px;'>{$cat['category_name']}<img src='/common/images/down.gif' class='downarrowclass' style='border:0;'></a>";
			getSubcategory($cat['category_id']);
		}
		$lstNews = $news->getNewsTitleFromCat($parentId);
		foreach ($lstNews as $i){
			echo "<li style='z-index: 100;'><a href='/{$i['title_no_sign']}.html' title='{$i['title']}'  class='' style='padding-right: 23px;'>{$i['title']}<img src='/common/images/down.gif' class='downarrowclass' style='border:0;'></a>";
		}
		echo '</ul>';
    }
?>