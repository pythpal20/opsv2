<?php 
include 'config.php';
	session_start();
    if (!isset($_SESSION['username'])){
        header("Location: login.php");
	}
	
	$level=$_SESSION["level"];

	if ($level!='user') {
    echo "Anda tidak punya akses pada halaman admin <a href='login.php'>Klik disini</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PT. SENECA |Wellcome</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="admin/assets/img/snc.png">
<!-- Load Css -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- load CSS -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="lib/animate/animate.css">
    <link href="lib/jquery/jquery.min.js">
    <link href="lib/wow/wow.min.js">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
</head>
<!-- paulus christofel | native web -->
<body>
<?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">PT. SENECA INDONESIA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="vd_kendaraan.php">Data Kendaraan</a>
          <a class="dropdown-item" href="vd_skb.php">Data SKB</a>
		  <a class="dropdown-item" href="vd_kir.php">Data KIR</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="vd_all.php">Semua Data</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tambah Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="fm_kendaraan.php">Data Kendaraan</a>
          <a class="dropdown-item" href="fm_skb.php">Data SKB</a>
		  <a class="dropdown-item" href="fm_kir.php">Data KIR</a>
      </li>
    </ul>
    <button class="btn btn-warning"><a href="logout.php">Logout</a></button>
  </div>
</nav>
<br>
<!-- bagian body -->
					<?php 
						$KodeAlat = $_GET['id'];
						$query ="SELECT * FROM m_kendaraan WHERE kode_alat = '$KodeAlat'";
						$dewan1 = $db1->prepare($query);
		        		$dewan1->execute();
		        		$res1 = $dewan1->get_result();
						$row = $res1->fetch_assoc();
					?>
<div class="container">
<center>
<p class="h2">Form Edit Kendaraan</p>
</center>
<form action="edprokend.php" method="post">
	<table class="table table-borderless">
    	<tr>
        	<td>Kode Alat</td>
            <td><input type="text" class="form-control" name="KodeAlat" value="<?php echo $row['kode_alat']; ?>" readonly></td>
        </tr>
        <tr>
        	<td>Jenis Kendaraan</td>
            <td>
            	<input type="text" name="jkendaraan" class="form-control" value="<?php echo $row['jns_kendaraan']; ?>">
            </td>
            <td>Merk</td>
            <td><input type="text" class="form-control" name="merk" value="<?php echo $row['merk']; ?>"></td>
        <tr>
            <td>No. Rangka</td>
            <td><input type="text" class="form-control" name="nork" value="<?php echo $row['no_rangka']; ?>"></td>
            
            <td>No. Mesin</td>
            <td><input type="text" class="form-control" name="nomsn" value="<?php echo $row['no_mesin']; ?>"></td>
    	</tr>
        <tr>
        	<td>Kondisi</td>
            <td>
            	<select name="kondisi" class="form-control">
					<option value="<?php echo $row['kondisi']; ?>"><?php echo $row['kondisi']; ?></option>
                	<option value="rusak">Rusak</option>
                    <option value="jalan">Jalan</option>
                    <option value="standby">Standby</option>
                </select>
            </td>
            <td>Lokasi</td>
            <td><input type="text" class="form-control" name="lokasi" value="<?php echo $row['lokasi']; ?>"></td>
        </tr>
        <tr>
        	<td></td>
            <td>
            	<button type="submit" class="btn btn-warning">Simpan</button>
            </td>
        </tr>
    </table>
</form>
</div>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="lib/jquery/jquery.min.js"></script>
</body>
</html>