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
        header('location: fme_kend.php?error=' .base64_encode('kode alat tidak boleh kosong'));
    }

    if (empty($jkendaraan)) {
        header('location: ./fme_kend.php?error=' .base64_encode('Jenis Kendaraan Harus dipilih'));   
    }

    if (empty($merk)) {
        header('location: ./fme_kend.php?error=' .base64_encode('Merk tidak boleh kosong'));   
    }
    if (empty($nomsn)) {
        header('location: ./fme_kend.php?error=' .base64_encode('No Mesin Harus diisi'));   
    }
	if (empty($nork)) {
        header('location: ./fme_kend.php?error=' .base64_encode('No Rangka Harus diisi'));   
    }
	if (empty($lokasi)) {
        header('location: ./fme_kend.php?error=' .base64_encode('Lokasi Harus diisi'));   
    }
	if (empty($kondisi)) {
        header('location: ./fme_kend.php?error=' .base64_encode('kondisi Harus diisi'));   
    }

    // SQL Insert
			$query="UPDATE m_kendaraan SET jns_kendaraan='$jkendaraan', merk='$merk', no_rangka= '$nork', no_mesin='$nomsn', kondisi='$kondisi', lokasi='$lokasi' WHERE kode_alat='$KodeAlat'";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './fme_kend.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vd_kendaraan.php';</script>";
    				}
			}
?>