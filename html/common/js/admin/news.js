$(document).ready(function(){
	var validator = $("#form1").validate({
		rules:{
			txt_title:"required",
			/*txtPrice:{
				required:true,
				digits:true
				},*/
			file:{
				accept:"jpeg|png|jpg"
				}
		},
		messages:{
			txt_title:"Bạn chưa nhập tiêu đề!",
			/*txtPrice:{
				required:"Bạn chưa nhập giá tiền!",
				digits:"Chỉ nhập số"
				},*/
			file:{
				accept:"Chỉ cho phép các kiểu file: jpeg, jpg, png"
				}
		}
	});
	
	$('body').on('click', '#btn_submit', function(){
		document.form1.submit();
	});
	
	$('body').on('click','.btn_delete',function(){
		if(confirm('Bạn có chắc muốn xóa bài viết?')){
			var id = $(this).attr('id');
			id = id.replace('item_','');
			location.href='/admin/news/delete/' + id;
		}
	});
});