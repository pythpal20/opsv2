<?php
if (isset($_POST['KodeAlat']) && $_POST['KodeAlat']) {
    include 'config.php';
	$KodeAlat = $_POST['KodeAlat'];
    $nobpkb = $_POST['nobpkb'];
    $tgl_pajak = $_POST['tgl_pajak'];

    // cek nilai variable
    if (empty($KodeAlat)) {
        header('location: ./update_pajak.php?error=' .base64_encode('Kode Alat tidak boleh kosong'));
    }

    if (empty($nobpkb)) {
        header('location: ./update_pajak.php?error=' .base64_encode('NO BPKB tidak boleh kosong'));   
    }

    if (empty($tgl_pajak)) {
        header('location: ./update_pajak.php?error=' .base64_encode('Tanggal Pajak tidak boleh kosong'));   
    }

    // SQL Insert
			$query="UPDATE m_skb SET tgl_pajak='$tgl_pajak' WHERE kode_alat='$KodeAlat' ";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './update_pajak.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './index.php';</script>";
    				}
			}
?>