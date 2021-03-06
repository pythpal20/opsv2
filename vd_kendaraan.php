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

<?php 
    $s_keyword="";
        if (isset($_POST['search'])) {
        $s_keyword = $_POST['s_keyword'];
        }
?>
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
    <form class="form-inline my-2 my-lg-0" method="post" action="">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="s_keyword" id="s_keyword" value="<?php echo $s_keyword; ?>">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" id="search" name="search">Search</button>
    </form>
    <button class="btn btn-warning"><a href="logout.php">Logout</a></button>
  </div>
</nav>
<br>
<br>
<!-- bagian body -->
<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
    	<div class="card">
        	<div class="card-header card-header-info">
            	<h4 class="card-title ">Data Kendaraan</h4>
            </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table">
		<thead class="text-primary">
				<th>No</th>
				<th>Kode Alat</th>
				<th>Jenis Kendaraan</th>
				<th>Merk</th>
				<th>No Rangka</th>
                <th>No Mesin</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
				<th>Action</th>
		</thead>
		<tbody>
			<?php
				$batas = 10;
				$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

				$previous = $halaman - 1;
				$next = $halaman + 1;

				$search_keyword = '%'. $s_keyword .'%';
				$query="SELECT * FROM m_kendaraan WHERE kode_alat LIKE ? OR jns_kendaraan LIKE ? OR merk LIKE ? OR no_rangka LIKE ? OR no_mesin LIKE ? OR kondisi LIKE ? OR lokasi LIKE ? ORDER BY kode_alat DESC";
				$dewan1 = $db1->prepare($query);
				$dewan1->bind_param('sssssss', $search_keyword, $search_keyword, $search_keyword, $search_keyword, $search_keyword,$search_keyword,$search_keyword);
				$dewan1->execute();
				$res1 = $dewan1->get_result();
					while ($row = $res1->fetch_assoc()) {
						$data[]=$row;
					}
					
				$jumlah_data = count($data);
				$total_halaman = ceil($jumlah_data / $batas);
				
				$query1="SELECT *
				FROM m_kendaraan
				WHERE kode_alat LIKE ? OR jns_kendaraan LIKE ? OR merk LIKE ? OR no_rangka LIKE ? OR no_mesin LIKE ? OR kondisi LIKE ? OR lokasi LIKE ? ORDER BY kode_alat limit $halaman_awal, $batas";
				$dewan1 = $db1->prepare($query1);
				$dewan1->bind_param('sssssss', $search_keyword, $search_keyword, $search_keyword, $search_keyword, $search_keyword,$search_keyword,$search_keyword);
				$dewan1->execute();
				$nomor = $halaman_awal+1;
				$res1 = $dewan1->get_result();
				if ($res1->num_rows > 0) {
		            while ($row = $res1->fetch_assoc()) {
		                $KodeAlat = $row['kode_alat'];
		                $jkendaraan = $row['jns_kendaraan'];
		                $merk = $row['merk'];
		                $nork = $row['no_rangka'];
		                $nomsn = $row['no_mesin'];
						$kondisi = $row['kondisi'];
						$lokasi = $row['lokasi'];
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $KodeAlat; ?></td>
				<td><?php echo $jkendaraan; ?></td>
				<td><?php echo $merk; ?></td>
				<td><?php echo $nork; ?></td>
                <td><?php echo $nomsn; ?></td>
                <td><?php echo $kondisi; ?></td>
                <td><?php echo $lokasi; ?></td>
				<td>
					<a href="fme_kend.php?id=<?php echo $row['kode_alat']; ?>"><i class="material-icons">create</i></a><a href="dlt_ken.php?id=<?php echo $row['kode_alat']; ?>"><i class="material-icons">remove_circle</i></a>
				</td>
			</tr>
			<?php } } else { ?>
			<tr>
				<td colspan='7'>Tidak ada data ditemukan</td>
			</tr>
		    <?php } ?>
		</tbody>
	</table>
	<nav>
		<ul class="pagination justify-content-center">
			<li class="page-item">
				<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
			</li>
			<?php 
				for($x=1;$x<=$total_halaman;$x++){
			?> 
			<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
				<?php
					}
				?>				
			<li class="page-item">
				<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
			</li>
		</ul>
	</nav>
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
</body>
</html>