<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PT SENECA | LOGIN</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="admin/assets/img/snc.png">
<!-- load CSS -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="lib/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<!-- load JS -->
	<link href="lib/jquery/jquery.min.js" rel="stylesheet" type="text/javascript">
	<link href="js/bootstrap.min.js" rel="stylesheet" type="text/javascript">
</head>
<!-- paulus christofel | native web -->

 <body>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-transparent mb-0"><h5 class="text-center">Please <span class="font-weight-bold text-primary">LOGIN</span></h5></div>
            <div class="card-body">
              <form action="act_login.php" method="post">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                </div>
                <div class="form-group">
                  <input type="submit" name="" value="Login" class="btn btn-primary btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	 <script type="text/javascript" src="js/bootstrap.js"></script>
	 <script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
	 <script type="text/javascript" src="js/moment.min.js"></script>
  </body>
</html>