<?php
include 'functions.php';
if (empty($_SESSION['login']))
	header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="favicon.ico" />

	<title>Source Code Forecasting WMA</title>
	<link href="assets/css/cosmo-bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/general.css" rel="stylesheet" />
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/highcharts.js"></script>
	<script src="assets/js/modules/exporting.js"></script>
	<script src="assets/js/modules/export-data.js"></script>
	<script src="assets/js/modules/accessibility.js"></script>
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="?">WMA</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php if (_session('login')) : ?>
						<li><a href="?m=jenis"><span class="glyphicon glyphicon-th-large"></span>Manajemen Data</a></li>
						<li><a href="?m=periode"><span class="glyphicon glyphicon-calendar"></span>Manajemen Periode</a></li>
						<li><a href="?m=wma"><span class="glyphicon glyphicon-stats"></span>Hitung Peramalan</a></li>
						<li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span>Password</a></li>
						<li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
					<?php else : ?>
						<li><a href="?m=wma"><span class="glyphicon glyphicon-stats"></span>Hitung</a></li>
						<li><a href="?m=tentang"><span class="glyphicon glyphicon-info-sign"></span>Tentang</a></li>
						<li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<?php
		if (!_session('login') && !in_array($mod, array('', 'home', 'hitung', 'login', 'tentang', 'des', 'wma')))
			$mod = 'login';

		if (file_exists($mod . '.php'))
			include $mod . '.php';
		else
			include 'home.php';
		?>
	</div>
	<!-- <footer class="footer bg-primary">
		<div class="container">
			<p>Copyright &copy; <?= date('Y') ?> Abdul Harist Sundawa <em class="pull-right">Skripsi Teknik Informatika</em></p>
		</div>
	</footer> -->
	<script type="text/javascript">
		$('.form-control').attr('autocomplete', 'off');
	</script>
</body>

</html>