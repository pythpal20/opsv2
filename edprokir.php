<?php
if (isset($_POST['id']) && $_POST['id']) {
    include 'config.php';
	$id = $_POST['id'];
    $nokir = $_POST['nokir'];
    $KodeAlat = $_POST['KodeAlat'];
    $tglkir = $_POST['tglkir'];
    $lokir = $_POST['lokir'];

    // cek nilai variable
    if (empty($nokir)) {
        header('location: ./fm_kir.php?error=' .base64_encode('No KIR tidak boleh kosong'));
    }

    if (empty($KodeAlat)) {
        header('location: ./fm_kir.php?error=' .base64_encode('Kode Alat Harus dipilih'));   
    }

    if (empty($tglkir)) {
        header('location: ./fm_kir.php?error=' .base64_encode('Tanggal KIR tidak boleh kosong'));   
    }
    if (empty($lokir)) {
        header('location: ./fm_kir.php?error=' .base64_encode('Lokasi KIR Harus diisi'));   
    }

    // SQL Insert
			$query="UPDATE m_kir SET nokir='$nokir', kode_alat='$KodeAlat', tgl_kir='$tglkir', lokir='$lokir' WHERE id='$id' ";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './fm_kir.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vd_kir.php';</script>";
    				}
			}
?>