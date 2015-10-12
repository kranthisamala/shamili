<?php
include 'minium_log.php';
session_start();
if(isset($_POST['to'])&&isset($_POST['content']))
{
	$to=$_POST['to'];
	$content=$_POST['content'];
	if(isset($_SESSION['sid']))
	{
		$from=$_SESSION['sid'];
		$res=mysql_fetch_assoc(mysql_query("SELECT * FROM `login_teacher` WHERE `username`='$to'"));
		$to=$res['tid'];
		$type='s';
		if(mysql_query("INSERT INTO `mail`(`to`, `from`, `content`, `type`) VALUES ('$to','$from','$content','$type')"))
		{
			header('Location:index.php');
		}
	}
	else if(isset($_SESSION['tid']))
	{
		$from=$_SESSION['tid'];
		$res=mysql_fetch_assoc(mysql_query("SELECT * FROM `login` WHERE `username`='$to'"));
		$to=$res['sid'];
		$type='t';
		if(mysql_query("INSERT INTO `mail`(`to`, `from`, `content`, `type`) VALUES ('$to','$from','$content','$type')"))
		{
			header('Location:index.php');
		}
	}
	else{
		header('Location:index.php');
	}
}
else
{
	echo "bollo";
}
?>