<?php 
	include 'config.php';
	$query = "SELECT id, title, start, end, color, keterangan FROM events"; 
	$snc = $db1->prepare($query); 
	$snc->execute();
	$events = $snc->get_result();
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
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link rel="icon" type="image/png" href="admin/assets/img/snc.png"/>
	<!-- Load Css -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- load CSS -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/fullcalendar.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet">
	<style>
		body {
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
			}
			#calendar {
			max-width: 800px;
			}
			.col-centered{
			float: none;
			margin: 0 auto;
		}
	</style>   	
</head>
<!-- paulus christofel | native web -->
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="#">PT. SENECA INDONESIA</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="nav collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="index.php">Home</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Data</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="vd_kendaraan.php">Data Kendaraan</a>
					<a class="dropdown-item" href="vd_skb.php">Data SKB</a>
					<a class="dropdown-item" href="vd_kir.php">Data KIR</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="vd_all.php">Semua Data</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tambah Data</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="fm_kendaraan.php">Data Kendaraan</a>
					<a class="dropdown-item" href="fm_skb.php">Data SKB</a>
					<a class="dropdown-item" href="fm_kir.php">Data KIR</a>
				</div>
			</li>
		</ul>
		<button class="btn btn-warning"><a href="logout.php">Logout</a></button>
	</div>
</nav>
<br>
<!-- conten -->
<div class="content">
	<div class="container">
		<div class="card bg-light">
			<div class="card-header card-header-tabs bg-info">
				<h4 class="card-title">Notifikasi Surat Kendaraan Dan KIR</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="card card-stat">
							<div class="card-header bg-warning">
								<p class="card-category text-white">Pajak dalam Bulan ini</p>
							</div>
							<div class=card-body>
								<?php
									$query1="SELECT * FROM m_skb";
									$dewan1 = $db1->prepare($query1);
									$dewan1->execute();
									$res1 = $dewan1->get_result();
									if ($res1->num_rows > 0) {
										while ($row = $res1->fetch_assoc()) {
											$nama_kar_notif = $row['kode_alat'];
											$tanggal_akhir_kontrak = $row['tgl_pajak'];   
								?>
								<?php
									$tanggal_akhir = new DateTime($tanggal_akhir_kontrak); 
									$tanggal_now = new DateTime();
									$lama = $tanggal_now->diff($tanggal_akhir);
									if ($lama->days > 7 AND $lama->days < 30) {
								?>	
								<div id="card-alert" class="alert alert-warning alert-dismissible card col-sm-12" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar Pajak <?php echo "$lama->d"?> hari lagi </p> <a class="btn btn-sm btn-info" href="update_pajak.php?id=<?php echo $row['kode_alat']; ?>">update</a>

									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									<?php
										}
										if($lama->days < 7 AND $lama->days > 0){
									?>
								<div id="card-alert" class="alert alert-danger alert-dismissible card col-sm-12" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-alert-error"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar Pajak <?php echo "$lama->d"?> hari lagi</p><a class="btn btn-sm btn-info" href="update_pajak.php?id=<?php echo $row['kode_alat']; ?>">update</a>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php }
									}
								} ?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="card card-stat">
							<div class="card-header bg-primary">
								<p class="card-category text-white">STNK dalam Bulan ini</p>
							</div>
							<div class="card-body">
								<?php
									$query1="SELECT * FROM m_skb";
									$dewan1 = $db1->prepare($query1);
									$dewan1->execute();
									$res1 = $dewan1->get_result();
									if ($res1->num_rows > 0) {
										while ($row = $res1->fetch_assoc()) {
											$nama_kar_notif = $row['kode_alat'];
											$tgl_stnk = $row['tgl_stnk'];   
								?>
								<?php
									$tanggal_akhir = new DateTime($tgl_stnk); 
									$tanggal_now = new DateTime();
									$lama = $tanggal_now->diff($tanggal_akhir);
									if ($lama->days > 7 AND $lama->days < 30) {
								?>	
								<div id="card-alert" class="alert alert-warning alert-dismissible card green col s12 fade show" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar STNK <?php echo "$lama->d"?> hari lagi</p><a class="btn btn-sm btn-info" href="update_stnk.php?id=<?php echo $row['kode_alat']; ?>">update</a>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php
									}
									if($lama->days < 7 AND $lama->days > 0){
								?>
								<div id="card-alert" class="alert alert-danger alert-dismissible card green fade show" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-alert-error"></i> Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar STNK <?php echo "$lama->d"?> hari lagi</p><a class="btn btn-sm btn-info" href="update_stnk.php?id=<?php echo $row['kode_alat']; ?>">update</a>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php }
									}
								} ?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="card card-stat">
							<div class="card-header bg-success">
								<p class="card-category text-white">KIR dalam Bulan ini</p>
							</div>
							<div class="card-body">
								<?php
									$query1="SELECT * FROM m_kir";
									$dewan1 = $db1->prepare($query1);
									$dewan1->execute();
									$res1 = $dewan1->get_result();
									if ($res1->num_rows > 0) {
										while ($row = $res1->fetch_assoc()) {
											$nama_kar_notif = $row['kode_alat'];
											$tanggal_akhir_kontrak = $row['tgl_kir'];   
								?>
								<?php
									$tanggal_akhir = new DateTime($tanggal_akhir_kontrak); 
									$tanggal_now = new DateTime();
									$lama = $tanggal_now->diff($tanggal_akhir);
									if ($lama->days > 7 AND $lama->days < 30) {
								?>
								<div id="card-alert" class="alert alert-warning alert-dismissible card green col s12 fade show" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> KIR <?php echo "$lama->d"?> hari lagi</p><a class="btn btn-sm btn-info" href="update_kir.php?id=<?php echo $row['kode_alat']; ?>">update</a>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php
									}
									if($lama->days < 7 AND $lama->days > 0){
								?>
								<div id="card-alert" class="alert alert-danger alert-dismissible card green fade show" role="alert">
									<div class="card-content white-text">
										<p style="text-align: left;"><i class="mdi-alert-error"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> KIR <?php echo "$lama->d"?> hari lagi</p><a class="btn btn-sm btn-info" href="update_kir.php?id=<?php echo $row['kode_alat']; ?>">update</a>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php }
									}
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /conten -->
<script src="js/jquery.js"></script>
<script src="lib/jquery/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="admin/assets/js/plugins/moment.min.js"></script>
<script src="admin/assets/js/plugins/fullcalendar.min.js"></script>	
<script>
	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: $('#calendar').fullCalendar('today'),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #keterangan').val(event.keterangan);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					keterangan: '<?php echo $event['keterangan']; ?>',
				},
			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});
</script>
</body>
</html>