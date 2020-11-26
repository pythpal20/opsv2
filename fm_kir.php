<?php 
include 'konn.php';
session_start();
    if (!isset($_SESSION['username'])){
        header("Location: login.php");
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
		  </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
    </form>
    <button class="btn btn-warning"><a href="logout.php">Logout</a></button>
  </div>
</nav>
<br>
<br>
<!-- bagian body -->
<div class="container">
<center><p class="h2">Form Tambah KIR</p></center>
<form method="post" action="kirproc.php" class="form-group">
	<table align="center" class="table table-borderless">
    	<tr>
        	<td>No KIR</td>
            <td ><input type="text" class="form-control-sm" name="nokir" placeholder="No Kir"></td>
            <td >
            	<select name="KodeAlat" id="KodeAlat" class="form-control-sm" onChange="changeValue(this.value)">
                	<option value="">Pilih Kode Alat</option>
                    <?php 
 						$query=mysqli_query($con, "SELECT * FROM m_skb ms JOIN m_kendaraan mk ON ms.kode_alat = mk.kode_alat ORDER BY ms.kode_alat"); 
 						$result = mysqli_query($con, "SELECT * FROM m_skb ms JOIN m_kendaraan mk ON ms.kode_alat = mk.kode_alat");  
						$jsArray = "var dtAlat = new Array();\n";
 						while ($row = mysqli_fetch_array($result)) {  
 						echo '<option value="' . $row['kode_alat'] . '">' . $row['kode_alat'] . '</option>';  
 						$jsArray .= "dtAlat['" . $row['kode_alat'] . "'] = {jskendaraan:'".addslashes($row['merk'])."',jsmerk:'".addslashes($row['no_mesin'])."'};\n";
  						}
  					?>
                     <!-- nanti ambil dari database dengan Query -->
                </select>
			</td>
        </tr>
        <tr class="form-control-sm">
			<td>Kendaraan</td>
            <td><input type="text" class="form-control-sm" name="jkendaraan" id="prdJkendaraan" placeholder="Merk" readonly></td>
            <td><input type="text" class="form-control-sm" name="merk" id="prdMerk" placeholder="No Mesin"  readonly></td>
       </tr>
       <tr>
			<td>Tanggal KIR</td>
			<td/><input placeholder="Tanggal Kir" type="text" class="form-control-sm datepicker" name="tglkir"></td>
            <td>
            	<select name="lokir" class="form-control-sm" id="lokir">
                	<option value="">== Lokasi Kir ==</option>
                    <option value="Biro Jasa">Biro Jasa</option>
                    <option value="Proyek">Proyek</option>
                    <option value="Pusat">Pusat</option>
                </select>
            </td>
		</tr>
        <tr>
            <td></td>
            <td>
            	<button type="submit" class="btn btn-warning">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </td>
        </tr>
	</table>
</form>
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