<?php
    // SQL Insert
			include 'config.php';
			$KodeAlat = $_GET['id'];
			$query="DELETE FROM m_kendaraan WHERE kode_alat='$KodeAlat'";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './vuser.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vuser.php';</script>";
    				}
?>