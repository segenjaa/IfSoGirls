<?php
	require_once('dbconn.php');
	
	class CGirl
	{
		public $girlid;
		public $girlname;
		public $imagesrc;
		public $record;
		function __construct($id, $name, $image, $record)
		{
			$this->girlid = $id;
			$this->girlname = $name;
			$this->imagesrc = $image;
			$this->record = $record;
		}
	}
	
	function getgirlsinfo()
	{
		$girls = array();
		$dbConn = new CDBConn();
		$strsql = '';
		$strsql .= 'SELECT girl.girlid,girl.usrid,girl.name,girl.path,temp.num ';
		$strsql .= 'FROM girl ';
		$strsql .= 'LEFT JOIN ';
		$strsql .= '( ';
		$strsql .= 'SELECT girlid,COUNT(usrid) AS num ';
		$strsql .= 'FROM record ';
		$strsql .= 'GROUP BY girlid ';
		$strsql .= ')';
		$strsql .= 'AS temp ';
		$strsql .= 'ON girl.girlid=temp.girlid';
		
		$result = $dbConn->db_query($strsql);
		for($i=0; $i<$result->num_rows; ++$i)
		{
			$row = $result->fetch_assoc();
			$girlid = $row['girlid'];
			$record = $row['num'];
			if(is_null($record))
			{
				$record = 0;
			}
			$girls[$girlid] = new CGirl($girlid,$row['name'],$row['path'],$record);
		}
		$result->free();
		
		return $girls;
	}
	
	function getlovegirls($usrid)
	{
		$lovegirls = array();
		$dbConn = new CDBConn();
		$strsql = '';
		$strsql .= 'select girlid from record ';
		$strsql .= 'where usrid='.$usrid;
		$strsql .= ' group by girlid';
		
		$result = $dbConn->db_query($strsql);
		for($i=0; $i<$result->num_rows; ++$i)
		{
			$row = $result->fetch_assoc();
			$girlid = $row['girlid'];
			$lovegirls[$girlid] = $girlid;
		}
		$result->free();
		
		return $lovegirls;
	}
?>