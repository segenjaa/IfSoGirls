<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>如是女孩簿</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-mybox.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>

<body>
<?php
	//获取当前用户信息
	session_start();
	
	$bHaslogin = false;
	if(isset($_SESSION['usrid']))
	{
		$bHaslogin = true;
	}
?>
  <div id="header">
  	<span id="brand">IfSoGirls</span>
    <span class="right">
    <?php
			if($bHaslogin)
			{
				echo '欢迎您，'.$_SESSION['usrname'];
				echo ' |';
				echo '<a href="javascript:void(0);" onClick="usr_logout();">退出</a>';
			}
			else
			{
				echo '<a href="javascript:void(0);" onClick="usr_login();">登陆</a>';
				echo '|';
				echo '<a href="javascript:void(0);" onClick="register();">注册</a>';
			}
    ?>
    </span>
	</div>
  <div id="main">
  	<?php
		$leftglid = -1;
		if(isset($_GET['leftglid']))
		{
			$_SESSION['leftglid'] = $_GET['leftglid'];
			$leftglid = $_SESSION['leftglid'];
		}
		else if(isset($_SESSION['leftglid']))
		{
			$leftglid = $_SESSION['leftglid'];
		}
		
		$rightglid = -1;
		if(isset($_GET['rightglid']))
		{
			$_SESSION['rightglid'] = $_GET['rightglid'];
			$rightglid = $_SESSION['rightglid'];
		}
		else if(isset($_SESSION['rightglid']))
		{
			$rightglid = $_SESSION['rightglid'];
		}
		
		require_once('girlquery.php');
		$girls = getgirlsinfo();
		
		if(!array_key_exists($leftglid, $girls))
		{
			$leftglid = array_rand($girls,1);
			$_SESSION['leftglid'] = $leftglid;
		}
		$leftgirl = $girls[$leftglid];
		
		if(!array_key_exists($rightglid, $girls))
		{
			$rightglid = array_rand($girls,1);
			$_SESSION['rightglid'] = $rightglid;
		}
		$rightgirl = $girls[$rightglid];
		
		$lovegirls = NULL;
		if($bHaslogin)
		{
			$lovegirls = getlovegirls($_SESSION['usrid']);
		}
		
		//输出胜利者
		echo '<div id="pkresult">';
    echo '<span>';
		echo 'PK Winner<img alt="胜利者" title="winner" src="image/flag_mark_red.png">:';
		if($leftgirl->record > $rightgirl->record)
		{
			echo $leftgirl->girlname;
		}
		else if($leftgirl->record < $rightgirl->record)
		{
			echo $rightgirl->girlname;
		}
		else
		{
			echo 'No Winner';
		}
    echo '</span>';
		echo '</div>';
		
		outputgirl($bHaslogin, $girls, $leftgirl, 'girlleft', 'selleft', $lovegirls);
		outputgirl($bHaslogin, $girls, $rightgirl, 'girlright', 'selright', $lovegirls);
		function outputgirl($bHaslogin, $girls, $girlinfo, $divid, $selid, $lovegirls)
		{
			echo '<div id="'.$divid.'">';
			echo '<div class="girldesc">';
			echo '<select id="'.$selid.'">;';
			foreach($girls as $curgirl)
			{
				echo '<option value="'.$curgirl->girlid.'" ';
				if($curgirl->girlid == $girlinfo->girlid)
				{
					echo 'selected="selected"';
				}
				echo'>'.$curgirl->girlname.'</option>';
			}	
			echo '</select>';
			echo ' Love Heart <span class="lovenum">';
			echo $girlinfo->record;
			echo '</span>';
			if($bHaslogin)
			{
				echo '<br/>';
				
				if(array_key_exists($girlinfo->girlid, $lovegirls))
				{
					echo '已表白<img src="image/like_variation.png">';
				}
				else
				{
					echo '<a href="javascript:void(0);" onClick="add_love('.$girlinfo->girlid.');">';
					echo '表白吧<img title="+1" src="image/like_variation.png">';
					echo '</a>';
				}
			}
			echo '</div>';
			echo '<div class="girlface">';
			echo '<img class="girlimg" src="image/'.$girlinfo->imagesrc.'"/>';
			echo '</div>';
			echo '</div>';
		}
    ?>
	</div>
	<div id="footer">
		Copyright &copy; 2013 Segen Jaa.All rights reserved. 
	</div>
</body>
</html>
