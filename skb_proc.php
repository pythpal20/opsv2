<?php
if (isset($_POST['nobpkb']) && $_POST['nobpkb']) {
    include 'config.php';
    $nobpkb = $_POST['nobpkb'];
    $KodeAlat = $_POST['KodeAlat'];
    $stnk = $_POST['stnk'];
    $pajak = $_POST['pajak'];
	$NoPol = $_POST['NoPol'];
	$wrntnkb = $_POST['wrntnkb'];
	$lokstnk = $_POST['lokstnk'];
	$lokbpkb = $_POST['lokbpkb'];
	$tahun = $_POST['tahun'];
	$nama = $_POST['nama'];

    // cek nilai variable
    if (empty($nobpkb)) {
        header('location: ./fm_skb.php?error=' .base64_encode('No BPKB tidak boleh kosong'));
    }

    if (empty($KodeAlat)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Kode Alat Harus dipilih'));   
    }

    if (empty($stnk)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Tanggal STNK tidak boleh kosong'));   
    }
    if (empty($pajak)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Tanggal pajak Harus diisi'));   
    }
	if (empty($wrntnkb)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Wajib Memilih warna TNKB'));   
    }
	if (empty($nama)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Nama Harus diisi'));   
    }
	if (empty($tahun)) {
        header('location: ./fm_skb.php?error=' .base64_encode('Wajib Memilih Tahun '));   
    }

    // SQL Insert
			$query="INSERT INTO m_skb (nobpkb, kode_alat, tgl_stnk, tgl_pajak, nama, nopol, wrn_tnkb, lokstnk, lokbpkb, tahun) VALUES ('$nobpkb', '$KodeAlat', '$stnk', '$pajak', '$nama', '$NoPol', '$wrntnkb', '$lokstnk', '$lokbpkb', '$tahun')";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './fb_skb.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vd_skb.php';</script>";
    				}
			}
?>