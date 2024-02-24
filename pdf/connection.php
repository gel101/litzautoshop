<?php
Class dbObj{
	/* Database connection start */
	var $dbhost = "srv1327.hstgr.io";
	var $username = "u596510003_garage";
	var $password = "4&Aq?5~euRj";
	var $dbname = "u596510003_garagedb";
	
	var $conn;
	function getConnstring() {
		$con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}
?>