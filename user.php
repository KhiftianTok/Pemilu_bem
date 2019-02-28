<?php 
	require_once('koneksi.php');
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key  =  strip_tags($obj->key);
	$koneksi = koneksiDb();

	switch ($key) {
			
		case 'create':
			//$sql = "insert into users values ('','".$obj->username."','".$obj->password."','".$obj->name."','".$obj->email."')";
			$sql = "insert into mahasiswa values ('','".$obj->nim."','".$obj->nama."','".$obj->kode_jurusan."','".$obj->password."')";
			$hasil = mysqli_query($koneksi, $sql);
			if($hasil){
				$data["nik"] =$obj->nik;
			}else{
				$data["pesan"] = "gagal";
			}
			echo json_encode($data);
			break;
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
			break;
		
	}

	
?>