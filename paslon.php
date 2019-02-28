	<?php 
	require_once('koneksi.php');
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key  = strip_tags($obj->key);
	//$id_paslon = $_GET['id'];
	$koneksi = koneksi();

	switch ($key) {
			
		case 'create':
			//$sql = "insert into users values ('','".$obj->username."','".$obj->password."','".$obj->name."','".$obj->email."')";
			$sql = "insert into paslon values ('','".$obj->id_paslon."','".$obj->nim_ketua."','".$obj->nim_wakil."','".$obj->nama_partai."','".$obj->visi."','".$obj->misi."','".$obj->logo_partai."')";
			$hasil = mysqli_query($koneksi, $sql);
			if($hasil){
				$data["id_paslon"] =$obj->id_paslon;
			}else{
				$data["pesan"] = "gagal";
			}
			echo json_encode($data);
		break;
		
		case 'cari':
			$sql = "select * from paslon where id_paslon = '".$obj->id_paslon."' ";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['id_paslon']=$baris['id_paslon'];
				$data['nim_ketua']=$baris['nim_ketua'];
				$data['nim_wakil']=$baris['nim_wakil'];
				$data['nama_partai']=$baris['nama_partai'];
				$data['visi']=$baris['visi'];
				$data['misi']=$baris['misi'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'tampil':
			$sql = "select count(id_paslon) as jumlah from paslon";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			$i = 0;
			while($jumlah = mysqli_fetch_assoc($hasil)){
				$data[$i]['jumlah']=$jumlah['jumlah'];
				$i++;
			}
			echo json_encode($data);
			break;
		case 'tampilSemua':
			$sql = "SELECT id_paslon,nim_ketua,nim_wakil,nama_partai,visi,misi,logo_partai,image,mahasiswa.nama FROM paslon JOIN mahasiswa ON mahasiswa.nim = paslon.nim_ketua";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah=mysqli_num_rows($hasil);
			$i=0;
			while($jumlah = mysqli_fetch_assoc($hasil)){
				$data[$i]['id_paslon']=$jumlah['id_paslon'];
				$data[$i]['nim_ketua']=$jumlah['nim_ketua'];
				$data[$i]['nim_wakil']=$jumlah['nim_wakil'];
				$data[$i]['nama_partai']=$jumlah['nama_partai'];
				$data[$i]['visi']=$jumlah['visi'];
				$data[$i]['misi']=$jumlah['misi'];
				$data[$i]['logo_partai']=$jumlah['logo_partai'];
				$data[$i]['nama']=$jumlah['nama'];
				$i++;

		}
		

			echo json_encode($data);

			break;
			case 'tampilPaslon':
			$sql = "select id_paslon, nama_partai from paslon order by id_paslon";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah=mysqli_num_rows($hasil);
			$i=0;
			while($jumlah = mysqli_fetch_assoc($hasil)){

					$data[$i]['id_paslon']=$jumlah['id_paslon'];
					$data[$i]['nama_partai']=$jumlah['nama_partai'];
					$i++;
			}
			echo json_encode($data);
			break;

			case 'tampilDetail':
			$sql = "SELECT paslon.id_paslon,mahasiswa.nama,detail_kandidat.keterangan, paslon.nama_partai, paslon.visi, paslon.misi FROM paslon JOIN detail_kandidat ON paslon.id_paslon= detail_kandidat.id_paslon JOIN mahasiswa ON mahasiswa.nim=detail_kandidat.nim WHERE detail_kandidat.id_paslon= '".$obj->id_paslon."' ORDER BY keterangan";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah=mysqli_num_rows($hasil);
			$i=0;
			while($jumlah = mysqli_fetch_assoc($hasil)){
					$data[$i]['id_paslon']=$jumlah['id_paslon'];
					$data[$i]['nama']=$jumlah['nama'];
					$data[$i]['keterangan']=$jumlah['keterangan'];
					$data[$i]['nama_partai']=$jumlah['nama_partai'];
					$data[$i]['visi']=$jumlah['visi'];
					$data[$i]['misi']=$jumlah['misi'];
					$i++;
			}
			echo json_encode($data);
			break;

			case 'vote':
			//$sql = "insert into users values ('','".$obj->username."','".$obj->password."','".$obj->name."','".$obj->email."')";
			$sql = "insert into kotak_suara(nim, id_paslon, tanggal_pilih, waktu_pilih) values('".$obj->nim."',".$obj->id_paslon.", now(), CURRENT_TIME())";
			$sql2 = "update mahasiswa set status='S' where nim='".$obj->nim."'";
			//$sql = "insert into kotak_suara(nim, id_paslon, tanggal_pilih, waktu_pilih) values('111111111','25', now(), CURRENT_TIME())";
			//$sql2 = "update mahasiswa set status='S' where nim='111111111'";
			//$sql = "insert into kotak_suara(nim, id_paslon, tanggal_pilih, waktu_pilih) values('123456789',4, now(), CURRENT_TIME())";
			$hasil = mysqli_query($koneksi, $sql);
			$hasil2 = mysqli_query($koneksi, $sql2);
			if($hasil){
				$data["nim"] =$obj->nim;
			}else{
				$data["pesan"] = "gagal";
			}

			if($hasil2){
				$data["nim"] =$obj->nim;
			}else{
				$data["pesan"] = "gagal";
			}

			echo json_encode($data);
		break;
		case 'tampilNim':
			$sql = "Select nim, nama from mahasiswa where nama='".$obj->nama."'";
			$hasil = mysqli_query($koneksi,$sql);
			$jumlah = mysqli_num_rows($hasil);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['nim']=$baris['nim'];
				$data['nama']=$baris['nama'];
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;

	}

	
?>