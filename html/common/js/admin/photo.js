$(document).ready(function(){
	var validator = $("#form1").validate({
		rules:{
			txtPrice:{
				digits:true
				},
			file:{
				accept:"jpeg|png|jpg"
				}
		},
		messages:{
			txtPrice:{
				digits:"Chỉ nhập số"
				},
			file:{
				accept:"Chỉ cho phép các kiểu file: jpeg, jpg, png"
				}
		}
	});
	
	$('body').on('click', '#btn_submit', function(){
		document.form1.submit();
	});
	
	$('body').on('click','.btn_delete',function(){
		if(confirm('Bạn có chắc muốn xóa hình ảnh này?')){
			var id = $(this).attr('id');
			id = id.replace('item_','');
			location.href='/admin/photo/delete/' + id;
		}
	});
});