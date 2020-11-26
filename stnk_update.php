<?php
if (isset($_POST['KodeAlat']) && $_POST['KodeAlat']) {
    include 'config.php';
	$KodeAlat = $_POST['KodeAlat'];
    $jns_kendaraan = $_POST['jns_kendaraan'];
    $nobpkb = $_POST['nobpkb'];
    $tgl_stnk = $_POST['tgl_stnk'];

    // cek nilai variable
    if (empty($KodeAlat)) {
        header('location: ./update_stnk.php?error=' .base64_encode('Kode Alat tidak boleh kosong'));
    }

    if (empty($nobpkb)) {
        header('location: ./update_stnk.php?error=' .base64_encode('NO BPKB tidak boleh kosong'));   
    }

    if (empty($tgl_stnk)) {
        header('location: ./update_stnk.php?error=' .base64_encode('Tanggal stnk tidak boleh kosong'));   
    }

    // SQL Insert
			$query="UPDATE m_skb SET tgl_stnk='$tgl_stnk' WHERE kode_alat='$KodeAlat' ";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './update_stnk.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './index.php';</script>";
    				}
			}
?>