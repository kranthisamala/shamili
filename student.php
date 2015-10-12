<?php	
session_start();
if(isset($_SESSION['username']))
	{
		if(isset($_SESSION['type']))
		{
			if($_SESSION['type']=='s')
			{
				include 'minium_log.php';
?>
<html style="-webkit-tap-highlight-color: rgba(0,0,0,0);">
<head>
		<link rel="stylesheet" href="bootstrap-3.2.0-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/student.css">
		    <script type="text/javascript" src="js/jsapi.js"></script>
	<script type="text/javascript" src="js/uds_api_contents.js"></script>
</head>
<body style="background-color:#292931">
	<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li><a href="#" id="compose"><i class="fa fa-plus-square"></i> Compose Message</a></li>
				<li class="active"><a href="#" id="inbox">Inbox <span class="sr-only">(current)</span></a></li>
				<li><a href="#" id="sent">Sent</a></li>
				<li><a href="#" id="rating">Give Rating</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?php echo ($_SESSION['username']);?><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href='logout.php'><i class="fa fa-sign-in" style="color: inherit;"></i> Logout</a></li>
				  </ul>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
	</nav>
	<div class="container">
		<div class="row">
			<div style="position:relative;top:100px;">
				<div class="mid_block" id="compose_block" class="col-md-12">
					<form class="form-horizontal" action="mail.php" method="post">
						<div class="form-group input-group col-md-5">
							<span class="input-group-addon" id="basic-addon1">To</span>
							<select class="form-control" name="to" id="email" required>
								<?php
								$branch=$_SESSION['branch'];
								$sem=$_SESSION['sem'];
									$query=mysql_query("SELECT * FROM `login_teacher` WHERE `branch`='$branch' AND `sem`='$sem'");
									while($res=mysql_fetch_assoc($query))
									{
										$op=$res['username'];
										echo "<option>$op</option>";
									}
								?>
							</select>
							<span class="input-group-addon" id="basic-addon2">@shamili.com</span>
						</div>
						<div class="form-group col-md-7" style="padding:0px;maring:0px;">
							<textarea class="form-control" rows="12" name='content' placeholder="    Type here..........  " required></textarea>
						</div>	
						<div class="form-group col-md-7" style="padding:0px;maring:0px;">
							<button type="submit" class="btn btn-default">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
		<div class="mid_block" id="inbox_block" class="col-md-12" style="display:block;">
		<?php 
			$sid=$_SESSION['sid'];
			$query=mysql_query("SELECT * FROM `mail` WHERE `to`='$sid' AND`type`='t'");
			while($res=mysql_fetch_assoc($query))
			{
				$from=$res['from'];
				$res1=mysql_fetch_assoc(mysql_query("SELECT * FROM `login_teacher` WHERE `tid`='$from' "));
				$from=$res1['username'];
				echo "<div class='col-md-12'>
				<div class='mail_view col-md-8'>
						<div class='col-md-2'>".$from."</div>
						<div class='col-md-offset-6 col-md-4'>".(new DateTime($res['time']))->format('Y-m-d H:i:s')."</div>
					</div>
					<div class='col-md-8' style='background-color:black;height:1px;'></div>
					<div class='mail_containt col-md-8'>".$res['content']."</div>
					</div>
					";
			}
			if(mysql_num_rows($query)<=0)
			echo "<center style='color:red'>No Inbox Yet</center>";
		?>
		</div>
		<div class="mid_block" id="sent_block" class="col-md-12">
		<?php 
			$sid=$_SESSION['sid'];
			$query=mysql_query("SELECT * FROM `mail` WHERE `from`='$sid' AND`type`='s'");
			while($res=mysql_fetch_assoc($query))
			{
				$from=$res['to'];
				$res1=mysql_fetch_assoc(mysql_query("SELECT * FROM `login_teacher` WHERE `tid`='$from'"));
				$from=$res1['username'];
				echo "<div class='col-md-12'>
				<div class='mail_view col-md-8'>
						<div class='col-md-2'>".$from."</div>
						<div class='col-md-offset-6 col-md-4'>".(new DateTime($res['time']))->format('Y-m-d H:i:s')."</div>
					</div>
					<div class='col-md-8' style='background-color:black;height:1px;'></div>
					<div class='mail_containt col-md-8'>".$res['content']."</div>
					</div>
					";
			}
			if(mysql_num_rows($query)<=0)
			echo "<center style='color:red'>No Inbox Yet</center>";
		?>
		</div>
		<div class="mid_block" id="rating_block" class="col-md-12">
		<?php
		$branch=$_SESSION['branch'];
		$sem=$_SESSION['sem'];
		$sid=$_SESSION['sid'];
			$query=mysql_query("SELECT * FROM `login_teacher` WHERE `branch`='$branch' AND `sem`='$sem'");
			if(mysql_num_rows($query))
			{
				echo "<form class='form-horizontal' action='rate.php' method='post'>
					<div class='col-md-12' style='background-color:#eee;padding:5px;margin:-top:5px;'>
					<div class='col-md-3'>
					<i style='opacity:0'>kjbjbuh</i>
					<select name='name' class=' form-control' style='color:#000;'>";
				while($res=mysql_fetch_assoc($query))
				{
					$op=$res['username'];
					$sno=$res['tid'];
					echo "<option>
						  $op</option>";
				}
				
						 echo " </select></div><div class='col-md-1 rating_choice'>
							presentation<select id='sel_1'class='form-control' name='1'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
							</select>
						  </div>
						  <div class='col-md-1 rating_choice' >
							punctuality<select id='sel_2' class='form-control' name='2'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
							</select>
						  </div>
						  <div class='col-md-1 rating_choice' >
							interaction<select id='sel_3' class='form-control' name='3'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
							</select>
						  </div>
						  <div class='col-md-1 rating_choice' >
							cmd on sub<select id='sel_4' class='form-control' name='4'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
							</select>
						  </div>
						  <div class='col-md-1 rating_choice'>
							overall<select id='sel_5' class='form-control' name='5'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
							</select>
						  </div>
						  <div  class='col-md-offset-1 col-md-1'>
						  <i style='opacity:0'>kjbjbuh</i><button type='submit' class='btn btn-default send'>submit</button>
						  </div>
						 </div>
						 
						 </form>";
			}
		?>
		</div>
		</div>
	</div>
  <!---  <div id="visualization" style="width: 400px; height: 400px;background-color:black;"></div>-->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/student.js"></script>
</body>
</html>
<?php
			}
			else if($_SESSION['type']=='t')
			{
				header('Location: teacher.php');
			}
			else
			{
				header('Location: index.php');
			}
		}
	}
else
{
	header('Location: index.php');
}
?>
