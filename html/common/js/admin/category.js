$(document).ready(function() {
	
	$('body').on('click', '#btn_submit', function(){
		document.form1.submit();
	});
	
	$('body').on('click','#chk_top_menu',function(){
		$('#sp_top').toggle(this.checked);
	});
	$('body').on('click','#chk_mid_menu',function(){
		$('#sp_mid').toggle(this.checked);
	});
	$('body').on('click','#chk_bottom_menu',function(){
		$('#sp_bottom').toggle(this.checked);
	});
	$('body').on('click','.btn_delete',function(){
		if(confirm('Xóa danh mục sẽ xóa hết tất cả bài viết con của danh mục, bạn có chắc muốn xóa?')){
			var id = $(this).attr('id');
			id = id.replace('item_','');
			location.href='/admin/category/delete/' + id;
		}
	});

});