<?php
	include 'config.php';
	$query = "SELECT id, title, start, end, color FROM events"; 
	$snc = $db1->prepare($query); 
	$snc->execute();
	$events = $snc->get_result();
	session_start();
    if (!isset($_SESSION['username'])){
        header("Location: login.php");
	}
	
	$level=$_SESSION["level"];

	if ($level!='admin') {
    echo "Anda tidak punya akses pada halaman admin <a href='../index.php'>Klik disini</a>";
    exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/snc.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin | PT. SENECA IND
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link href="assets/css/fullcalendar.css" rel="stylesheet"/>
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
   <link href="assets/css/material-dashboard.css" rel="stylesheet" type="text/css">
   <link href="assets/js/core/bootstrap-material-design.min.js" rel="stylesheet" type="text/css">
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="admin.php" class="simple-text logo-normal">
          Admin | PT. SENECA
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="admin.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="fm_user.php">
              <i class="material-icons">person_add</i>
              <p>Tambah User</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="vuser.php">
              <i class="material-icons">person</i>
              <p>List User</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="adm_viewkendaraan.php">
              <i class="material-icons ">library_books</i>
              <p>Data Kendaraan</p>
            </a>
          </li>
		  <li class="nav-item ">
            <a class="nav-link" href="../logout.php">
              <p>Logout</p>
            </a>
          </li>
          <!--
          <li class="nav-item ">
            <a class="nav-link" href="./icons.html">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./map.html">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./rtl.html">
              <i class="material-icons">language</i>
              <p>RTL Support</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <!-- <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
				  <p class="d-lg-none d-md-block">
                  <?php echo $_SESSION['username']; ?>
				  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"><?php echo $_SESSION['username']; ?></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-azure card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">Total User</p>
                  <h3 class="card-title">
                  <?php
								$query = "SELECT COUNT(username) AS ju FROM user"; 
								$snc = $db1->prepare($query); 
								$snc->execute();
								$res1 = $snc->get_result();
								while ($row = $res1->fetch_assoc()) {
								echo $row['ju'];
								}
               				?>
                    <small>Orang</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">list</i>
                    <a href="vuser.php">Tampilkan data user</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">drive_eta</i>
                  </div>
                  <p class="card-category">Total Kendaraan</p>
                  <h3 class="card-title">
                  <?php
						$query = "SELECT COUNT(kode_alat) AS ja FROM m_kendaraan"; 
						$snc = $db1->prepare($query); 
						$snc->execute();
						$res1 = $snc->get_result();
						while ($row = $res1->fetch_assoc()) {
							echo $row['ja'];
							}
               	  ?>
                  <small>Unit</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">list</i>
					<a href="adm_viewkendaraan.php">Tampilkan data Kendaraan</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Kendaraan Rusak</p>
                  <h3 class="card-title">
                  <?php
						$query = "SELECT COUNT(kode_alat) AS jas FROM m_kendaraan WHERE kondisi ='Rusak'"; 
						$snc = $db1->prepare($query); 
						$snc->execute();
						$res1 = $snc->get_result();
						while ($row = $res1->fetch_assoc()) {
							echo $row['jas'];
							}
               	  ?> 
                  <small>Unit</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">list</i>
					<a href="adm_vkrusak.php">Tampilkan data</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">drive_eta</i>
                  </div>
                  <p class="card-category">Kendaraan Stanby</p>
                  <h3 class="card-title"><?php
						$query = "SELECT COUNT(kode_alat) AS jab FROM m_kendaraan WHERE kondisi ='Standby'"; 
						$snc = $db1->prepare($query); 
						$snc->execute();
						$res1 = $snc->get_result();
						while ($row = $res1->fetch_assoc()) {
							echo $row['jab'];
							}
               	  ?>
                  <small>Unit</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">list</i> 
					<a href="adm_vkstandby.php">Tampilkan data</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
		  <!-- isi konten calendar disini bossku -->
		<div class="container-fluid">
			<div class="card bg-secondary">
				<div class="card-header card-header-info">
					<h3 class="card-title">Notifikasi Surat Kendaraan Dan KIR</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card card-stat">
								<div class="card-header card-header-warning">
									<h4 class="card-category">Pajak dalam Bulan ini</h4>
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
											<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar Pajak <?php echo "$lama->d"?> hari lagi</p>
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
											<p style="text-align: left;"><i class="mdi-alert-error"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar Pajak <?php echo "$lama->d"?> hari lagi</p>
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
								<div class="card-header card-header-info">
									<h4 class="card-category">STNK dalam Bulan ini</h4>
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
											<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar STNK <?php echo "$lama->d"?> hari lagi</p>
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
											<p style="text-align: left;"><i class="mdi-alert-error"></i> Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> Bayar STNK <?php echo "$lama->d"?> hari lagi</p>
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
								<div class="card-header card-header-success">
									<h4 class="card-category">KIR dalam Bulan ini</h4>
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
											<p style="text-align: left;"><i class="mdi-action-info-outline"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> KIR <?php echo "$lama->d"?> hari lagi</p>
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
											<p style="text-align: left;"><i class="mdi-alert-error"></i>Kendaraan Dengan Kode : <b><?php echo $nama_kar_notif;?></b> KIR <?php echo "$lama->d"?> hari lagi</p>
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
          <!-- isi ama konten -->
		<footer class="footer">
			<div class="container-fluid">
				<nav class="float-left">
					<!-- tambahan footer 
					jika di perlukan
					-->
				</nav>
				<div class="copyright float-right">
					&copy;
					<script>
						document.write(new Date().getFullYear())
					</script>, PT. SENECA INDONESIA <i class="material-icons">copyright</i> by
					<a href="#" target="_blank">IT Staff</a> Team.
				</div>
			</div>
		</footer>
	</div>
  </div>
 </div>
</div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library /for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script src="assets/js/moment.min.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
  
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
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