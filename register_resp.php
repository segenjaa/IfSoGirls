<?php
  //返回json格式文件
  header("Content-Type:application/json");
	
	$usrname = $_POST['name'];
  $usrpwd = $_POST['pwd'];
	$usremail = $_POST['email'];
	
	require_once("dbconn.php");
  $dbConn = new CDBConn();
	
	//判断用户名是否已存在
	$strsql = 'select * from user where name =\''.$usrname.'\'';
	$result = $dbConn->db_query($strsql);
	if($result)
	{
		if($result->num_rows > 0)
		{
			$faltstr='用户名'.$usrname.'已存在';
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
	
	//添加用户
	$strsql = "";
	$strsql .= "insert into user(name,pwd,email) ";
	$strsql .= "values(";
	$strsql .= "'".$usrname."',";
	$strsql .= "sha1('".$usrpwd."'),";
	$strsql .= "'".$usremail."'";
	$strsql .= ")";
	
  $result = $dbConn->db_query($strsql);
  if($result)
  {
		$array = array('resflag'=>'success');
		echo json_encode($array);
  }
  else
  {
		$faltstr='添加用户错误：';
		$faltstr.=$strsql;
		$array = array('resflag'=>'fail','fault'=>$faltstr);
		echo json_encode($array);
  }
?>