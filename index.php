<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		if(isset($_SESSION['type']))
		{
			if($_SESSION['type']=='s')
			{
				header('Location: student.php');
			}
			else if($_SESSION['type']=='t')
			{
				header('Location: teacher.php');
			}
		}
	}
	else
	{
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        HTML Document Structure
    </title>
	<link rel="stylesheet" href="bootstrap-3.2.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<!-- Copy the snippet beween the body tags and use it in your website, if required -->
<div id="login_type">
	<div style="height:50px;width:3px;padding:0px;top:140px;left:670px;background-color:#6c5B6d;position:absolute;"></div>
	<table>
	<tr><td><div id="student_login">Login as Student</div></td>
		<td><div id="teacher_login">Login as Teacher</div></td>
	</tr>
	</table>
</div>
<div id="login_form">
	<form id="form" name="form" action="validate.php" method="post">
		<div id="block">
			<label id="user" for="name">p</label>
			<input type="text" name="name" id="name" placeholder="Username" required/>
			<label id="pass" for="password">k</label>
			<input type="password" name="password" id="password" placeholder="Password" required />
			<input type="text" name="type" value="" style="display:none;">
			<i  ></i>
			<input type="submit" id="submit" name="submit" value="submit"/>
		</div>
	</form>
	<div id="option"> 
		<p>Login</p> 
		<a href="#">forgot?</a>
	</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>
<?php
	}
?>
