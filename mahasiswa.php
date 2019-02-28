<?php 
	require_once('koneksi.php');
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key  =  strip_tags($obj->key);
	$koneksi = koneksi();

	switch ($key) {
			
		case 'create':
			//$sql = "insert into users values ('','".$obj->username."','".$obj->password."','".$obj->name."','".$obj->email."')";
			$sql = "insert into mahasiswa values('".$obj->nim."','".$obj->nama."','".$obj->kode_jurusan."','".$obj->password."','".$obj->status."')";
			$hasil = mysqli_query($koneksi, $sql);
			if($hasil){
				$data["nim"] =$obj->nim;
				$data["nama"] =$obj->nama;
				$data["kode_jurusan"] =$obj->kode_jurusan;
				$data["password"] =$obj->password;
				$data["status"] =$obj->status;
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
				$data['status']=$baris['status'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
			break;
		case 'duplicate':
			$sql = "select * from mahasiswa where nim = '".$obj->nim."' ";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				echo "NIM sudah ada";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
			break;
			
		case 'belumpilih':
			$sql = "select count(*) as jumlah from mahasiswa where status='B'";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			$i = 0;
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'totalmahasiswa':
			$sql = "select count(*) as jumlah from mahasiswa";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			$i = 0;
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'tanggalvote':
			$sql = "select tanggal_voting from jadwal where id_jadwal='1'";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			$i = 0;
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				if($baris['tanggal_voting']==date('Y-m-d')){
					 $data['tanggal_voting']='true';
				}else{
					 $data['tanggal_voting']='false';
				}
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		
	}

	
?>