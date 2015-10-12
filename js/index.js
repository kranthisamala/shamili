$(document).ready(function(){
	$("#option p").click(function(){
		$("#block").toggle();
	});
	$("#submit").click(function(){
		var user=$("#name").val();
		var pass=$("#password").val();
		if((user.length<=0)&&(pass.length<=0))
		{
			alert("please fill username and password fields");
		}
		else if(pass.length<=0)
		{
			alert("please fill  password field");
		}
		else if(user.length<=0)
		{
			alert("please fill username field");
		}
		else
		{
			alert("Everything is ok!");
		}
	});
	$("#student_login").click(function(){
		$("#login_form").css("display","block");
		$("#option p").text("Student");
		$("#block input[name='type']").attr("value","s");
	});
	$("#teacher_login").click(function(){
		$("#login_form").css("display","block");
		$("#option p").text("Teacher");
		$("#block input[name='type']").attr("value","t");
	});
});