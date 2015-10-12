
$(document).ready(function(){
	$("#compose,#inbox,#sent,#rating").click(function(){
		$(".active").removeClass("active");
		$(this).parent().addClass("active");
		$(".mid_block").css("display","none");
		var id= $(this).attr("id");
		$("#"+id+"_block").css("display","block");
	});
	$(".mail_view").click(function(){
		$(this).next().next().toggle();
	});
});