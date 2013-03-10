<?php
  //返回json格式文件
  header("Content-Type:application/json");
	
	$usrname = $_POST['name'];
  $usrpwd = $_POST['pwd'];
	
	require_once("dbconn.php");
  $dbConn = new CDBConn();
	
	//判断用户名是否已存在
	$strsql = "";
	$strsql .= 'select * from user ';
	$strsql .= 'where name =\''.$usrname.'\' ';
	$strsql .= 'and pwd =sha1(\''.$usrpwd.'\')';
	$result = $dbConn->db_query($strsql);
	if($result)
	{
		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			
			session_start();
			$_SESSION['usrid'] = $row['usrid'];
			$_SESSION['usrname'] = $row['name'];
			
			$array = array('resflag'=>'success');
			echo json_encode($array);
			
			exit;
		}
		else
		{
			$faltstr='用户不存在或密码错误';
			$array = array('resflag'=>'fail','fault'=>$faltstr);
			echo json_encode($array);
		
			exit;
		}
	}
	else
	{
		$faltstr='查询用户错误：';
		$faltstr.=$strsql;
		$array = array('resflag'=>'fail','fault'=>$faltstr);
		echo json_encode($array);
			
		exit;
	}
?>