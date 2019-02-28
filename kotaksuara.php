	<?php 
	require_once('koneksi.php');
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key  = strip_tags($obj->key);
	//$id_paslon = $_GET['id'];
	$koneksi = koneksi();

	switch ($key) {

		case 'statistik':
			$sql1 = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='4'";
			$sql2 = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='16'";
			$sql3 = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='17'";
			$sql4 = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='23'";
			$sql5 = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='25'";
			$hasil1 = mysqli_query($koneksi, $sql1);
			$hasil2 = mysqli_query($koneksi, $sql2);
			$hasil3 = mysqli_query($koneksi, $sql3);
			$hasil4 = mysqli_query($koneksi, $sql4);
			$hasil5 = mysqli_query($koneksi, $sql5);

			$jumlah1 = mysqli_num_rows($hasil1);
			$jumlah2 = mysqli_num_rows($hasil2);
			$jumlah3 = mysqli_num_rows($hasil3);
			$jumlah4 = mysqli_num_rows($hasil4);
			$jumlah5 = mysqli_num_rows($hasil5);
			$i = 0;
			while($jumlah1 = mysqli_fetch_assoc($hasil1) and $jumlah2 = mysqli_fetch_assoc($hasil2) and $jumlah3 = mysqli_fetch_assoc($hasil3) and $jumlah4 = mysqli_fetch_assoc($hasil4) and $jumlah5 = mysqli_fetch_assoc($hasil5) ){
				$data[$i]['jumlah1']=$jumlah1['jumlah'];
				$data[$i]['jumlah2']=$jumlah2['jumlah'];
				$data[$i]['jumlah3']=$jumlah3['jumlah'];
				$data[$i]['jumlah4']=$jumlah4['jumlah'];
				$data[$i]['jumlah5']=$jumlah5['jumlah'];
				$i++;
			}
			echo json_encode($data);
		break;
			
		case 'empat':
			$sql = "select count(id_kotak_suara) as jumlah, id_paslon from kotak_suara where id_paslon='4'";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'enambelas':
			$sql = "select count(id_kotak_suara) as jumlah from kotak_suara where id_paslon='16'";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'tujuhbelas':
			$sql = "select count(id_kotak_suara) as jumlah from kotak_suara where id_paslon='17'";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'duatiga':
			$sql = "select count(id_kotak_suara) as jumlah from kotak_suara where id_paslon='23'";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'dualima':
			$sql = "select count(id_kotak_suara) as jumlah from kotak_suara where id_paslon='25'";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['jumlah']=$baris['jumlah'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'menang':
			$sql = "SELECT id_paslon, COUNT(id_paslon) AS 'hasil' FROM kotak_suara GROUP BY id_paslon ORDER BY 'hasil' DESC LIMIT 1";
			$hasil = mysqli_query($koneksi, $sql);
			$jumlah = mysqli_num_rows($hasil);
			if($jumlah>0){
				$baris = mysqli_fetch_array($hasil);
				$data['id_paslon']=$baris['id_paslon'];
				$data['hasil']=$baris['hasil'];
				mysqli_close($koneksi);
			}else {
				$data['pesan'] = " data tidak ditemukan";
				mysqli_close($koneksi);
			}
			echo json_encode($data);
		break;
		case 'hasilmenang':
		$sql1="select tanggal_voting from jadwal where id_jadwal='1'";
		$hasil1 = mysqli_query($koneksi,$sql1);
		$jumlah1 = mysqli_num_rows($hasil1);
		if($jumlah1>0){
			$baris = mysqli_fetch_array($hasil1);
			if($baris['tanggal_voting']>date("Y-m-d")){
				
				$sql = "SELECT id_paslon, COUNT(id_paslon) AS 'hasil' FROM kotak_suara GROUP BY id_paslon ORDER BY 'hasil' DESC LIMIT 1";
				$hasil = mysqli_query($koneksi, $sql);
				$jumlah = mysqli_num_rows($hasil);
				if($jumlah>0){
					$baris = mysqli_fetch_array($hasil);
					$data['id_paslon']=$baris['id_paslon'];
					$data['hasil']=$baris['hasil'];
					mysqli_close($koneksi);
				}else {
					$data['pesan'] = " data tidak ditemukan";
					mysqli_close($koneksi);
				}
				echo json_encode($data);
			}else{
				echo json_encode('NULL');
			}
		}
		
		
			
		break;

	}

	
?>