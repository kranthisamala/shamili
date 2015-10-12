<?php
	require 'minium_log.php';
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
		else
		{
			echo "hello";
		}
	}
	else if(isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['type']))
	{
		$uname=$_POST['name'];
		$pass=$_POST['password'];
		if($_POST['type']=='s')
		{
			$query="SELECT * FROM login WHERE username='$uname' AND password='$pass'";
			if($res=mysql_query($query))
			{	
				if($val=mysql_num_rows($res))
				{	$val=mysql_fetch_assoc($res);
					include 'session.php';
					$_SESSION['username']=$uname;
					$_SESSION['sid']=$val['sid'];
					$_SESSION['sem']=$val['sem'];
					$_SESSION['type']='s';
					$_SESSION['branch']=$val['branch'];
					header('Location: student.php');
				}
				else
				{
					echo "<center style='color:red;'>Wrong Password or Id</center>";
				}
			}
			else
			{
				echo "<center style='color:red;'>Wrong Password or Id</center>";
			}
		}
		else
		{
			$query="SELECT * FROM login_teacher WHERE username='$uname' AND password='$pass'";
			if($res=mysql_query($query))
			{	
				if($val=mysql_num_rows($res))
				{
					$val=mysql_fetch_assoc($res);
					include 'session.php';
					$_SESSION['username']=$uname;
					$_SESSION['type']='t';
					$_SESSION['tid']=$val['tid'];
					$_SESSION['sem']=$val['sem'];
					$_SESSION['branch']=$val['branch'];
					header('Location: teacher.php');
				}
				else
				{
					echo "<center style='color:red;'>Wrong Password or Id</center>";
				}
			}
			else
			{
				echo "<center style='color:red;'>Wrong Password or Id</center>";
			}
		}
	}
	else
	{
		header('Location: index.php');
	}
?>