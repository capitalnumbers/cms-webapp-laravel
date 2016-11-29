
$(document).ready(function(){
	/*---------------- Menu Selected---------------*/
	if($(".current-page").length){
		$(".current-page").closest('ul').css('display','block');
		$(".current-page").closest('li').addClass('active');
	}

	$('body').on('click', '.delete', function(e){
		e.preventDefault();
		var t=$(this);
		$(this).jConfirm({ 
			message: 'Are you sure?', 
			confirm: 'YES', 
			cancel: 'NO', 
			openNow: this,
			callback: function(elem){ 
				$(t).closest('tr').hide();
				var url =$(t).attr('href');
				var id= $(t).attr('del_id');
				var token= $(t).find('input').val();
			 	$.ajax({ 
		            url:url,
		            type:'post',
		            data:{_token:token, id: id},
		            success: function(result){
		            	window.location.reload();    
		           }
			 	});
			} 

		}); 
	 	
	
	});
	/*$('body').on('click', '.delete_all', function(e){
		e.preventDefault();
		$(this).jConfirm({ 
			message: 'Are you sure?', 
			confirm: 'YES', 
			cancel: 'NO', 
			openNow: this,
			callback: function(elem){ 
				var del_id='';
				var url= $(this).attr('url');
				alert(url);
				$(".select_row").each(function(){
					del_id+=$(this).attr('del_id');
				});
				$.ajax({
					url: url,
					data:{'del_id',del_id},
					success:function(data){
						console.log(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
					  console.log(textStatus, errorThrown);
					}
				})
				alert('delete');
				//console.log(elem);
			//alert('According to the link you clicked...\r\nType = "'+elem.attr('itemType')+'" \r\n ID = "'+elem.attr('itemId')+'"');
				//window.location.href = elem.attr('href');
			} 
		}); */
	
	$("body").on('change', '.select_all', function () {
		if( $(this).prop("checked")){
			$(".del_div").show();
		}else{
			$(".del_div").hide();
		}
	    $("input:checkbox").prop('checked', $(this).prop("checked"));
	});
	
});
