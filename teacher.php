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
				<li><a href="#" id="rating">View Rating</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $_SESSION['username'];?><span class="caret"></span></a>
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
									$query=mysql_query("SELECT * FROM `login` WHERE `branch`='$branch' AND `sem`='$sem'");
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
							<textarea class="form-control" name="content" rows="12" placeholder="    Type here..........  " required></textarea>
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
			$tid=$_SESSION['tid'];
			$query=mysql_query("SELECT * FROM `mail` WHERE `to`='$tid' AND type='s'");
			while($res=mysql_fetch_assoc($query))
			{
				$from=$res['from'];
				$res1=mysql_fetch_assoc(mysql_query("SELECT * FROM `login` WHERE `sid`='$from'"));
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
			$tid=$_SESSION['tid'];
			$query=mysql_query("SELECT * FROM `mail` WHERE `from`='$tid' AND type='t'");
			while($res=mysql_fetch_assoc($query))
			{
				$from=$res['to'];
				$res1=mysql_fetch_assoc(mysql_query("SELECT * FROM `login` WHERE `sid`='$from'"));
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
			$tid=$_SESSION['tid'];
			$query=mysql_query("SELECT * FROM `rating` WHERE `tid`='$tid'");
			$s1=0;
			$s2=0;
			$s3=0;
			$s4=0;
			$s5=0;
			$myurl[]="['Option','Values']";
			$count=mysql_num_rows($query);
			while($res=mysql_fetch_assoc($query))
			{
				$s1+=$res['presentation'];
				$s2+=$res['punctuality'];
				$s3+=$res['interaction'];
				$s4+=$res['cmd on sub'];
				$s5+=$res['overall'];
			}
			if($count>0)
			{
				$s1=$s1/$count;
				$s2=$s2/$count;
				$s3=$s3/$count;
				$s4=$s4/$count;
				$s5=$s5/$count;
				$myurl[]="['Presentation',".$s1."]";
				$myurl[]="['Punctuality',".$s2."]";
				$myurl[]="['Interaction',".$s3."]";
				$myurl[]="['Cmd On Sub',".$s4."]";
				$myurl[]="['Overall',".$s5."]";
				echo "<div id='visualization' style='background-color:#292931;'></div>";
			}
			else{
				echo "<center style='color:red'>No one as rated you yet</center>";
			}
		?>
		</div>
		</div>
	</div>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/student.js"></script>
		<script type="text/javascript">
			function drawVisualization() {
			var data = google.visualization.arrayToDataTable([
				<?php echo(implode(",",$myurl));?>
				]);
				new google.visualization.BarChart(document.getElementById('visualization')).
				draw
				(
				  data,
				  {
					curveType: "function",
					width: 500, height: 400,
					vAxis: { maxValue: 10 },
					is3D:true,
					title: 'My Daily Rating',
				  }
				);
			}
			$(window).load(function(){
			$("rect[fill='#ffffff']").attr("fill","#292931");
			$("text[fill='#222222']").attr("fill","#ffffff");
			$("text[fill='#000000']").attr("fill","#ffffff");
			$("text[fill='#444444']").attr("fill","#ffffff");
			});
			drawVisualization();
		</script>
</body>
</html>

<?php
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
