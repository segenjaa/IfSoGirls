<?php
	class CDBConn
	{
		function __construct()
		{
			$this->db = new mysqli('localhost', 'root', '123', 'ifso_girls');
			if (mysqli_connect_errno())
			{
				echo 'Error:Could not connect to database. Please try again later.';
				exit;
			}
			
			 $this->db->query("SET NAMES 'UTF8'");
			 $this->db->query("SET CHARACTER SET 'UTF8'");
			 $this->db->query("SET CHARACTER_SET_RESULTS='UTF8'");
		}
		
		function __destruct()
		{
			$this->db->close();
		}
		
		public function db_query($query)
		{
			return $this->db->query($query);
		}
		
		private $db;
	}
?>
