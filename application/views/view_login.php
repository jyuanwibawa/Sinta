<!DOCTYPE html>
<html lang="en">

<head>
	<!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; child-src https://www.google.com; object-src 'none'; script-src 'self' https://www.google.com https://www.gstatic.com"> -->
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>LOGIN</title>
	<meta content="Pengadilan Negeri Surabaya" name="author" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script> -->
	<!-- Bootstrap CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Custom CSS     -->
	<link href="assets/css/evan.css" rel="stylesheet" />
	<!-- Itsform CSS     -->
	<link href="assets/css/itsform.css" rel="stylesheet" />
	<!-- template CSS     -->
	<link href="assets/css/material-dashboard.css" rel="stylesheet" />
	<!-- Custom Loader     -->
	<link href="assets/css/loader.css" rel="stylesheet" />
	<!-- Icon dan Font     -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<!-- <link href="assets/css/icon_dan_font.css?family=Roboto:400,700,300|Material+Icons" rel="stylesheet" type="text/css"> -->
	<!-- <script src="https://cdn.jsdelivr.net/gh/peterhry/CircleType@2.3.1/dist/circletype.min.js"></script> -->
	<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.fittext.js" type="text/javascript"></script>
</head>

<?php

if ($this->session->flashdata('result_login')) {
	?>

	<body onload="demo.showLoginerror('top','left')">
	<?php
	} else { ?>

		<body>
		<?php } ?>
		<!-- Loader 
	<div id="preloader">
	<div id="loader"></div>
	</div> -->
		<div class="if if-green">
			<div class="if-panel">
				<div class="if-panel-inner">
					<div class="d-flex flex-row justify-content-center align-items-center h2" style="width:100%">
							<img src="assets/docs/assets/img/sinta_logo.png" alt=<?php echo $this->config->item('long_app_name');?> style="height:200px">
							<!-- <?php echo $this->config->item('app_name');?> -->
					</div>
					<!-- <div class="d-flex flex-row justify-content-center align-items-center h4" style="width:100%">
							<?php //echo $this->config->item('long_app_name');?>
					</div> -->
					<div class="d-flex flex-row justify-content-center align-items-center" style="">
							<?php 
							$uruts=1;
							foreach($satker as $row){?>
								<div class="if-brand" style="display:flex;justify-content:center">
									<!-- <div id="nama_satker<?= $uruts?>" class="nama_satker" style="position:absolute;"><?= $row->nama_satker?></div>
									<div style="margin-top:32%"><img src="resources/user/<?= $row->logo?>" alt="<?= $row->nama_satker?>" style="object-fit:contain;height:40px"></div> -->
									<div style=""><img src="resources/user/<?= $row->logo?>" alt="<?= $row->nama_satker?>" style="object-fit:contain;height:40px"></div>
								</div>
								<div id="nama_satker<?= $uruts?>" class="nama_satker" style="font-size:8px"><?= $row->nama_satker?></div>
							
							<?php $uruts++; } ?>
							<!-- <div class="if-brand">
								<img src="assets/dist/img/logopn.png" alt="logo" style="object-fit:contain;height:40px">
							</div>
							<div class="if-brand">
								<img src="assets/dist/img/logobpn.png" alt="logo" style="object-fit:contain;height:40px">
							</div> -->
					</div>
					<?php
					if (validation_errors() || $this->session->flashdata('result_login')) {
						?>
						<div class="alert alert-danger alert-with-icon" data-notify="container">
							<i class="material-icons" data-notify="icon">notifications</i>
							<strong>Peringatan!</strong>
							<span data-notify="message"><?php echo validation_errors(); ?></span>
							<span data-notify="message"><?php echo $this->session->flashdata('result_login'); ?></span>
						</div>

					<?php } ?>

					<div class="if-form">
						<div class="if-forms">
							<!-- Form: 0 -->
							<form id="form_login" name="form_login" action="<?php echo base_url('masuk'); ?>" method="post" enctype="multipart/form-data" onsubmit="return false">
								<div class="if-group">
									<label for="email">Email</label>
									<input type="email" id="email" name="email" autocomplete="email" class="form-control" required="">
								</div>
								<div class="if-group password-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" autocomplete="current-password" class="form-control" required="">
								</div>

								<!--<div class="" style="width:100%;text-align:center">
									<div id="adityo" style="display:inline-block"></div>
								</div>
								<br>
								<input type="hidden" id="capcay" name="capcay" value="" required>-->
								<button type="submit" class="btn btn-danger" style="width:100%;height:50px" id="tbl_submit">
									Masuk
								</button>
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="if-main" style="background-image: url('assets/dist/img/header.jpeg')">

				<div class="if-text-foot">
					Copyright &copy;
					<script>
						document.write(new Date().getFullYear())
					</script>
					<a href="http://pn-surabayakota.go.id"><strong>Pengadilan Negeri Surabaya</strong></a> All Rights Reserved. <strong>Waktu Eksekusi :</strong> {elapsed_time}, <strong>Penggunaan Memori :</strong> {memory_usage}
				</div>
			</div>
		</div>
		<!-- <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script> -->
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/js/material.min.js" type="text/javascript"></script>
		<script src="assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
		<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
		<!-- <script src="assets/js/core.js"></script> -->
		<!-- Library for adding dinamically elements -->
		<script src="assets/js/arrive.min.js" type="text/javascript"></script>
		<!-- Forms Validations Plugin -->
		<script src="assets/js/jquery.validate.min.js"></script>
		<!-- Material Dashboard javascript methods -->
		<!-- <script src="assets/js/material-dashboard.js?v=1.2.1"></script> -->
		<!-- Material Dashboard DEMO methods, don't include it in your project! -->
		<!-- <script src="assets/js/demo.js"></script> -->
		<!-- <script src="assets/js/itsform.js"></script> -->
		</body>


		<script type="text/javascript">
			// var lingkarantext = new CircleType(document.getElementById('nama_satker1'));
			// window.addEventListener('resize', function updateRadius() {
			// 	lingkarantext.radius(lingkarantext.element.offsetWidth / 2);
			// });
			// $(lingkarantext.element).fitText();
			// updateRadius();
			// var lingkarantext2 = new CircleType(document.getElementById('nama_satker2'));
			// window.addEventListener('resize', function updateRadius() {
			// 	lingkarantext2.radius(lingkarantext2.element.offsetWidth / 2);
			// });
			// $(lingkarantext2.element).fitText();

			// var verifyCallback = function(response) {
			// 	if (response.length === 0) {
			// 		$("form[name='form_login']").attr('onsubmit', 'return false');
			// 	} else {
					$("form[name='form_login']").attr('onsubmit', 'return true');
			// 		$("#capcay").val(response);
			// 	}
			// };
			// var onloadCallback = function() {
			// 	grecaptcha.render('adityo', {
			// 	'sitekey' : '6LdBePMpAAAAAIe4Ah6NP9pqUhzO0-dc864CsLq0',
			// 	'callback' : verifyCallback,
			// 	'theme' : 'dark'
        	// 	});
			// };

			$(function() { // ganti dari yang lama: .load() --> cuma dipake di jquery 1.10+
				$(window).on("load", function() {
					$('#preloader').fadeOut('slow', function() {
						$(this).remove();
					});
				});
			});

			
		</script>
		

</html>