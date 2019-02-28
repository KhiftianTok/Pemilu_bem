<?php 
	require_once('koneksi.php');
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key  =  strip_tags($obj->key);
	$koneksi = koneksi();

	switch ($key) {
			
		case 'create':
			//$sql = "insert into users values ('','".$obj->username."','".$obj->password."','".$obj->name."','".$obj->email."')";
			$sql = "insert into jurusan values ('','".$obj->kode_jurusan."','".$obj->nama_jurusan."','".$obj->jenjang."')";
			$hasil = mysqli_query($koneksi, $sql);
			if($hasil){
				$data["kode_jurusan"] =$obj->kode_jurusan;
			}else{
				$data["pesan"] = "gagal";
			}
			echo json_encode($data);
			break;
		/*
		case 'cari':
			$sql = "select * from mahasiswa where nim = '".$obj->nim."' ";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['nim']=$baris['nim'];
				$data['nama']=$baris['nama'];
				$data['kode_jurusan']=$baris['kode_jurusan'];
				$data['password']=$baris['password'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
			break;*/
		
	}

	
?>