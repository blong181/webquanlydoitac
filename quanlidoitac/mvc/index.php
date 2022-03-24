<?php
include "Model/DBConfig.php";
$db = new Database;
$db->connect();
ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>ĐÀO TẠO HỢP TÁC KHOA CNTT & TT</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<style type="text/css">
		.header {

			color: white;
			padding: 10px;
			text-align: center;
		}


		.table {
			margin: auto;

		}

		/* setting the text-align property to center*/
		.borderless tr td {
			border: none !important;

		}

		.sidebar {
			position: sticky;
			z-index: 100;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
			var navpos = $('#mainnav').offset();
			console.log(navpos.top);
			$(window).bind('scroll', function() {
				if ($(window).scrollTop() > navpos.top) {
					$('#mainnav').addClass('navbar-fixed-top');
				} else {
					$('#mainnav').removeClass('navbar-fixed-top');
				}
			});
		});
	</script>
</head>

<body style="overflow-x: hidden;">
	<div class="p-3 mb-2 bg-primary text-white">
		<div class="header">

			<?php
			$path = "../mvc/View/admin/img/logo.png";
			?>

			<h2 align="center"> <img src='<?php echo $path; ?>' width="100" height="100" />
				KHOA CÔNG NGHỆ THÔNG TIN <br>& TRUYỀN THÔNG </h2>
		</div>

	</div>
	<div class="navbar navbar-default sidebar" id="mainnav">
		<?php


		if (isset($_GET['controller'])) {
			$controller = $_GET['controller'];
		} else {
			$controller = 'client';
		}

		$path = 'View/' . $controller . "/menu.php";

		include_once($path);

		?>
	</div>

	<div class="main">
		<div class="dsdoitac">
			<div class="row">
				<?php
				if (isset($_GET['controller'])) {
					$controller = $_GET['controller'];
				} else {
					$controller = 'client';
				}
				switch (($controller)) {
					case 'admin': {
						if(isset($_SESSION['submit']))
							{
								include_once('Controller/admin/index.php');
								break;
							}
						}

					case 'client': {
							include_once('Controller/client/index.php');
							break;
						}
				}

				?>
			</div>
		</div>
		<br>
		<br>
</body>

</html>