<?php
if (isset($_POST['id']) && $_POST['id']) {
    include 'config.php';
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
	$level = $_POST['level'];

    // cek nilai variable
    if (empty($id)) {
        header('location: ./fm_user.php?error=' .base64_encode('id tidak boleh kosong'));
    }

    if (empty($nama)) {
        header('location: ./fm_user.php?error=' .base64_encode('Jenis Kendaraan Harus dipilih'));   
    }

    if (empty($username)) {
        header('location: ./fm_user.php?error=' .base64_encode('Merk tidak boleh kosong'));   
    }
    if (empty($password)) {
        header('location: ./fm_user.php?error=' .base64_encode('No Mesin Harus diisi'));   
    }
	if (empty($level)) {
        header('location: ./fm_user.php?error=' .base64_encode('No Rangka Harus diisi'));   
    }

    // SQL Insert
			$query="UPDATE `user` SET nama='$nama', username='$username', password= MD5('$password'), level='$level' WHERE id='$id'";
		    $snc = $db1->prepare($query);
		    $snc->execute();
		    $res1 = $snc->get_result();
    // jika gagal
			if ($res1->num_rows > 0){
        		echo "<script>alert('".$dbl->error."'); window.location.href = './euseradd.php';</script>";
    			} else {
        			echo "<script>alert('Insert Data Berhasil'); window.location.href = './vuser.php';</script>";
    				}
			}
?>