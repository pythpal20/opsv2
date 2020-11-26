<?php
if (isset($_POST['KodeAlat']) && $_POST['KodeAlat']) {
    include 'config.php';
	$KodeAlat = $_POST['KodeAlat'];
    $jns_kendaraan = $_POST['jns_kendaraan'];
    $tgl_kir = $_POST['tgl_kir'];
    $nokir = $_POST['nokir'];

    // cek nilai variable
    if (empty($KodeAlat)) {
        header('location: ./update_kir.php?error=' .base64_encode('Kode Alat tidak boleh kosong'));
    }

    if (empty($nokir)) {
        header('location: ./update_kir.php?error=' .base64_encode('NO KIR tidak boleh kosong'));   
    }

    if (empty($tgl_kir)) {
        header('location: ./update_kir.php?error=' .base64_encode('Tanggal KIR tidak boleh kosong'));   
    }

    // SQL Insert
			$query="UPDATE m_kir SET tgl_kir='$tgl_kir' WHERE kode_alat='$KodeAlat' ";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './update_kir.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './index.php';</script>";
    				}
			}
?>