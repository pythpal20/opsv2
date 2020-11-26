<?php
if (isset($_POST['KodeAlat']) && $_POST['KodeAlat']) {
    include 'config.php';
    $KodeAlat = $_POST['KodeAlat'];
    $jkendaraan = $_POST['jkendaraan'];
    $merk = $_POST['merk'];
    $nork = $_POST['nork'];
	$nomsn = $_POST['nomsn'];
	$kondisi = $_POST['kondisi'];
	$lokasi = $_POST['lokasi'];

    // cek nilai variable
    if (empty($KodeAlat)) {
        header('location: ./fm_kendaraan.php?error=' .base64_encode('Kode alat tidak boleh kosong'));
    }

    if (empty($jkendaraan)) {
        header('location: ./fm_kendaraan.php?error=' .base64_encode('Jenis Kendaraan Harus dipilih'));   
    }

    if (empty($merk)) {
        header('location: ./fm_kendaraan.php?error=' .base64_encode('Merk tidak boleh kosong'));   
    }
    if (empty($nomsn)) {
        header('location: ./fm_kendaraan.php?error=' .base64_encode('No Mesin Harus diisi'));   
    }
	if (empty($nork)) {
        header('location: ./fm_kendaraan.php?error=' .base64_encode('No Rangka Harus diisi'));   
    }

    // SQL Insert
			$query="INSERT INTO m_kendaraan (`kode_alat`, `jns_kendaraan`, `merk`, `no_rangka`, `no_mesin`, `kondisi`, `lokasi`) VALUES ('$KodeAlat', '$jkendaraan', '$merk', '$nork', '$nomsn', '$kondisi', '$lokasi')";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './fm_kendaraan.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vd_kendaraan.php';</script>";
    				}
			}
?>