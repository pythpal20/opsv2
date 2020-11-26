<?php   
	include 'konn.php';
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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link rel="icon" type="image/png" href="admin/assets/img/snc.png"/>
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
<!-- bagian body -->
<div class="container">
<center><p class="h2">Form Input Berkas SKB</p></center>
<div class="row">
<form method="post" action="skb_proc.php">
	<table class="table table-borderless my-md-2">
    	<tr>
    		<td>No. BPKB</td>
            <td ><input class="form-control mr-sm-2" type="text" name="nobpkb" placeholder="No BPKB"></td>
            <td>Kode Alat</td>
            <td>
            	<select name="KodeAlat" id="KodeAlat" class="form-control-sm" onChange="changeValue(this.value)">
                	<option disabled="" selected="">Pilih Kode Alat</option>
                    <?php  
						$query=mysqli_query($con, "SELECT * FROM m_kendaraan kode_alat"); 
 						$result = mysqli_query($con, "SELECT * FROM m_kendaraan");  
						$jsArray = "var dtAlat = new Array();\n";
 						while ($row = mysqli_fetch_array($result)) {  
						echo '<option value="' . $row['kode_alat'] . '">' . $row['kode_alat'] . '</option>';  
 						$jsArray .= "dtAlat['" . $row['kode_alat'] . "'] = {jskendaraan:'" . addslashes($row['no_mesin']) . "',jsmerk:'".addslashes($row['merk'])."'};\n";
  						}
  					?>
                     <!-- nanti ambil dari database dengan Query -->
                </select>
            </td>
        </tr>
		
        <tr>
        	<td>Merk</td>
            <td><input type="text" class="form-control" name="merk" id="prdMerk" readonly></td>
            <td>No Mesin</td>
            <td><input type="text" class="form-control" name="jkendaraan" id="prdJkendaraan" readonly></td>
		</tr> 
		<tr>
			<td>Nama</td>
			<td><input type="text" class="form-control-sm" name="nama" placeholder="nama" ></td>
			<td>
				<select name="tahun" id="tahun" class="form-control-sm">
					<option selected="selected">Tahun</optiom>
					<?php
						for($i=date('Y');$i >= date('Y')-32;$i-=1){
							echo"<option value='$i'>$i</option>";
						}
					?>
				</select>
			</td>
		</tr>
        <tr>
			<td>STNK</td>
            <td><input placeholder="Tanggal STNK" type="text" class="form-control datepicker mr-sm-2" name="stnk"></td>
            <td><input placeholder="Tanggal Pajak" type="text" class="form-control datepicker mr-sm-2" name="pajak"></td>
			<td><input placeholder="No. Polisi" type="text" class="form-control mr-sm-2" name="NoPol"><td>
        </tr>
        <tr>
        	<td>Warna TNKB</td>
            <td>
            	<select class="form-control mr-sm-2" name="wrntnkb">
                	<option value="">Pilih Warna TNKB</option>
                    <option value="Hitam">Hitam</option>
                    <option value="Kuning">Kuning</option>
                 </select>
            </td>
            <td>
            	<select class="form-control mr-sm-2" name="lokstnk">
                	<option value="">Lokasi STNK</option>
                    <option value="Biro Jasa">Biro Jasa</option>
                    <option value="Proyek">Proyek</option>
                    <option value="Pusat">Pusat</option>
                 </select>
            </td>
            <td>
            	<select class="form-control mr-sm-2" name="lokbpkb">
                	<option value="">Lokasi BPKB</option>
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
                <button type="reset" class="btn btn-danger">Reset</button>
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