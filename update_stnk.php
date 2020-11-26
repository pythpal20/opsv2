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
<title>PT. SENECA|UPDATE</title>
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
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Update STNK</h4>
            <p class="card-category">Update STNK Setelah melakukan Perpanjangan STNK</p>
          </div>
          <?php
            $id = $_GET['id'];
            $query ="SELECT * FROM m_skb ms
            JOIN m_kendaraan mk ON ms.kode_alat= mk.kode_alat 
            WHERE ms.kode_alat='$id'";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();
            $row = $res1->fetch_assoc();
          ?>
          <div class="card-body">
            <form method="post" action="stnk_update.php">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kode Alat</label>
                    <input type="text" class="form-control" name="KodeAlat" value="<?php echo $row['kode_alat']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-floating">Jenis Kendaraan</label>
                    <input type="text" class="form-control" name="jns_kendaraan" value="<?php echo $row['jns_kendaraan']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-floating">No BPKB</label>
                    <input type="text" class="form-control" name="nobpkb" value="<?php echo $row['nobpkb']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-static">Tanggal STNK</label>
                    <input type="date" class="form-control" name="tgl_stnk" value="<?php echo $row['tgl_stnk']; ?>">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info pull-right">UPDATE!</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/datetimepicker/js/bootstrap-datepicker.min.js"></script>
</body>
</html>