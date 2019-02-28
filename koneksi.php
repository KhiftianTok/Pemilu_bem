<?php
	function koneksi(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pemilu_bem";
		
	$koneksi = mysqli_connect($servername, $username, $password, $dbname);
			
	if(!$koneksi){
		die("Koneksi Gagal: ".mysqli_connect_error());
	}
	return $koneksi;
	}

?>