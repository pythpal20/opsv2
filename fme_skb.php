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
<title>PT. SENECA|Wellcome</title>
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
    <link rel="stylesheet" type="text/css" href="lib/datetimepicker/css/bootstrap-datepicker.min.css">
    <script type="text/javascript" src="lib/datetimepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
    <script type="text/javascript">
 		$(function(){
  		$(".datepicker").datepicker({
      		format: 'yyyy-mm-dd',
      		autoclose: true,
      		todayHighlight: true,
  		});
 	});
	</script>
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
						$nobpkb = $_GET['id'];
						$query ="SELECT nobpkb,nama, mk.kode_alat, jns_kendaraan, merk, tgl_stnk, tgl_pajak, wrn_tnkb, nopol, lokstnk, lokbpkb, tahun
								FROM m_skb ms
								JOIN m_kendaraan mk ON mk.kode_alat = ms.kode_alat
								WHERE ms.nobpkb = '$nobpkb'";
						$dewan1 = $db1->prepare($query);
		        		$dewan1->execute();
		        		$res1 = $dewan1->get_result();
						$row = $res1->fetch_assoc();
					?>
<div class="container">
<center><p class="h2">Form Input Berkas SKB</p></center>
<div class="row">
<form method="post" action="edproskb.php">
	<table class="table table-borderless my-md-2">
    	<tr>
    		<td>No. BPKB</td>
            <td ><input class="form-control-sm" type="text" name="nobpkb" value="<?php echo $row['nobpkb']; ?>" readonly></td>
            <td>Kode Alat</td>
            <td>
            	<input type="text" name="KodeAlat" id="KodeAlat" class="form-control-sm" value="<?php echo $row['kode_alat']; ?>" readonly>
            </td>
        </tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" class="form-control-sm" name="nama" value="<?php echo $row['nama']; ?>" ></td>
			<td>
				<select name="tahun" id="tahun" class="form-control-sm">
					<option selected="selected" value="<?php echo $row['tahun']; ?>">Tahun <?php echo $row['tahun']; ?></optiom>
					<?php
						for($i=date('Y');$i >= date('Y')-32;$i-=1){
							echo"<option value='$i'>$i</option>";
						}
					?>
				</select>
			</td>
        <tr>
        	<td>Jenis Kendaraan</td>
            <td><input type="text" class="form-control-sm" name="jkendaraan" value="<?php echo $row['jns_kendaraan']; ?>" readonly></td>
            <td>Merk</td>
            <td><input type="text" class="form-control-sm" name="merk" value="<?php echo $row['merk']; ?>" readonly></td>
		</tr> 
        <tr>
			<td>STNK</td>
            <td><input value="<?php echo $row['tgl_stnk']; ?>" type="text" class="form-control-sm datepicker" name="stnk"></td>
            <td><input value="<?php echo $row['tgl_pajak']; ?>" placeholder="Tanggal Pajak" type="text" class="form-control-sm datepicker" name="pajak"></td>
			<td><input value="<?php echo $row['nopol']; ?>" type="text" class="form-control-sm" name="NoPol"><td>
        </tr>
        <tr>
        	<td>Warna TNKB</td>
            <td>
            	<select class="form-control mr-sm-2" name="wrntnkb">
                	<option value="<?php echo $row['wrn_tnkb']; ?>"><?php echo $row['wrn_tnkb']; ?></option>
                    <option value="Hitam">Hitam</option>
                    <option value="Kuning">Kuning</option>
                 </select>
            </td>
            <td>
            	<select class="form-control mr-sm-2" name="lokstnk">
                	<option value="<?php echo $row['lokstnk']; ?>">Lokasi STNK : <?php echo $row['lokstnk']; ?></option>
                    <option value="Biro Jasa">Biro Jasa</option>
                    <option value="Proyek">Proyek</option>
                    <option value="Pusat">Pusat</option>
                 </select>
            </td>
            <td>
            	<select class="form-control mr-sm-2" name="lokbpkb">
                	<option value="<?php echo $row['lokbpkb']; ?>">Lokasi BPKB : <?php echo $row['lokbpkb']; ?></option>
                    <option value="Biro Jasa">Biro Jasa</option>
                    <option value="Proyek">Bank</option>
                    <option value="Pusat">Akunting</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>
            	<button class="btn btn-warning" type="submit">Simpan</button>
            </td>
        </tr>
    </table>
</form>
</div>
</div>
<script type="text/javascript"> 
<?php echo $jsArray; ?>
	function changeValue(item){
    document.getElementById('prdJkendaraan').value = dtAlat[item].jskendaraan;
    document.getElementById('prdMerk').value = dtAlat[item].jsmerk;
};
</script>
<!-- end bagian body -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/datetimepicker/js/bootstrap-datepicker.min.js"></script>
</body>
</html>