<?php 
include_once("./config.php");
$result = mysqli_query($koneksi, "SELECT * FROM gudang_barang ORDER BY nama_barang DESC"); 
$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.ico">
	<!--Import Google Icon Font-->
    <link href="./fonts/material.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
	       /* label color */
	       .e-input-field label {
	         color: #000;
	       }
	       /* label focus color */
	       .e-input-field input[type=text]:focus + label,.e-input-field input[type=password]:focus + label {
	         color: #d32f2f !important;
	       }
	       /* label underline focus color */
	       .e-input-field input[type=text]:focus,.e-input-field input[type=password]:focus {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* valid color */
	       .e-input-field input[type=text].valid,.e-input-field input[type=password].valid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* invalid color */
	       .e-input-field input[type=text].invalid,.e-input-field input[type=password].invalid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* icon prefix focus color */
	       .e-input-field .prefix.active {
	         color: #d32f2f !important;
	       }
	    </style>
</head>
<body>
	<div class="row">
		<!--header-->
		<header>
			<!--TopNav-->
	        <nav class="row top-nav red darken-2">
	    		<div class="container">
	    			<div class="col offset-l2 nav-wrapper">
	    				<a href="#" data-activates="slide-out" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
	    				<a class="page-title">Tambah Barang</a>
	    			</div>
	    		</div>
			</nav>

			<!--Sidenav-->
			<ul id="slide-out" class="side-nav fixed">            
	            <li class="no-padding">
		            <ul class="collapsible collapsible-accordion">           
		                <li><div class="divider" style="margin-top:15%;"></div></li>
		                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>
						<li><a href="tambah_barang.php" class="collapsible-header">Tambah Data Barang<i class="material-icons">edit</i></a></li>
						<li><a href="data_barang.php" class="collapsible-header">Edit Data Barang<i class="material-icons">edit</i></a></li>
						<li><a href="gudang_barang.php" class="collapsible-header">Gudang Barang<i class="material-icons">person</i></a></li>
		            </ul>
	            </li>
	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
						<table>
							<tr>
								<td colspan='9'>
									<button id="myBtn" class="right waves-effect waves-light btn red darken-2">Tambah Barang<i class="material-icons right">add</i></button>
								</td>	
							</tr>	
						</table>

						<div id="myModal" class="modal">
								<div class="modal-content">
									<span class="close">&times;</span>
											<div class="row container">
													<!--table-->
												<form action="" method="post" name="form1">
														<table class="highlight">
															<!--kolom isian table-->
															<tr>
															<th>Gambar Barang</th>
															<th><input type="file" name="gambar_barang" required></th>
															</tr>
															<tr>
															<th>Nama Barang</th>
															<th><input type="text" name="nama_barang" required></th>
															</tr>
															<tr>
																<th>Harga Beli</th>
																<th><input type="text" onkeypress="return hanyaAngka(event)" name="harga_beli" placeholder="Masukkan Angka tanpa titik, Misal: 200000" required></th>
															</tr>
															<tr>
																<th>Harga Jual</th>
																<th><input type="text" onkeypress="return hanyaAngka(event)" name="harga_jual" placeholder="Masukkan Angka tanpa titik, Misal: 200000" required></th>
															</tr>
															<tr>
																<th>Stok</th>
																<th><input type="text" onkeypress="return hanyaAngka(event)" name="stok" placeholder="Masukkan Angka tanpa titik, Misal: 5" required></th>
															</tr>
														</table>
														<table>
															<tr>
																<th>
																	<input action="gudang_barang.php" type="submit" name="tambah" value="Input Barang" class="right waves-effect waves-light btn green darken-2" style="float: left;">
																</th>
																<th style="width: 1%;">
																	<a href="data_barang.php"><input type="button" value="Kembali" class="right waves-effect waves-light btn red darken-2"></a> 
																</th>
															</tr>
														</table>
												</form>
											</div>

											<?php
											// Check If form submitted, insert form data into users table.
											if(isset($_POST['tambah'])) {
												$nama_barang = $_POST['nama_barang'];
												$harga_beli = $_POST['harga_beli'];
												$harga_jual = $_POST['harga_jual'];
												$stok = $_POST['stok'];
												
												// include database connection file
												include_once("../config.php");
													
												// Insert user data into table
												$result = mysqli_query($koneksi, "INSERT INTO gudang_barang(nama_barang,harga_beli,harga_jual,stok) VALUES('$nama_barang','$harga_beli','$harga_jual','$stok')"); 
													if ($result){
														echo "<script>alert('Tambah Barang Berhasil ! Nama Barang : $nama_barang')</script>";
													} else {
														echo "<script>alert('Tambah Barang Gagal, Nama Barang Telah Digunakan ! Nama Barang : $nama_barang')</script>";
													}												
											}

											?>
								</div>
							</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>

	<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>

		<script>
			var modal = document.getElementById("myModal");
			var btn = document.getElementById("myBtn");
			var span = document.getElementsByClassName("close")[0];
			btn.onclick = function() {
			modal.style.display = "block";
			}
			span.onclick = function() {
			modal.style.display = "none";
			}
			window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
			}
		</script>
</body>
</html>