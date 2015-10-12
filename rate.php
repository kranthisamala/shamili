<?php
include 'minium_log.php';
session_start();
if(isset($_POST['name']))
{
	$to=$_POST['name'];
	if(isset($_SESSION['sid']))
	{
		$from=$_SESSION['sid'];
		$res=mysql_fetch_assoc(mysql_query("SELECT * FROM `login_teacher` WHERE `username`='$to'"));
		$to=$res['tid'];
		$s1=$_POST['1'];
		$s2=$_POST['2'];
		$s3=$_POST['3'];
		$s4=$_POST['4'];
		$s5=$_POST['5'];
		if(mysql_query("INSERT INTO `rating`(`tid`, `presentation`, `punctuality`, `interaction`, `cmd on sub`, `overall`, `sid`) VALUES ('$to','$s1','$s2','$s3','$s4','$s5','$from')"))
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