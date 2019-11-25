<?php session_start();
include_once("../config.php");
$page = (isset($_GET['page']))? $_GET['page'] : 1;
$limit = 1; // Jumlah data per halamannya
$limit_start = ($page - 1) * $limit;
          
$result = mysqli_query($koneksi, "SELECT * FROM gudang_barang LIMIT ".$limit_start.",".$limit);

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.ico">
	<!--Import Google Icon Font-->
    <link href="../fonts/material.css" rel="stylesheet">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
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
	    				<a class="page-title">Gudang Barang</a>
	    			</div>
	    		</div>
			</nav>

			<!--Sidenav-->
			<ul id="slide-out" class="side-nav fixed">            
	            <li class="no-padding">
		            <ul class="collapsible collapsible-accordion">
		                <li>
		                	<div class="user-view">
		                    	<div class="background" style="margin-bottom:-15%;">
		                    		<img src="../images/bg.jpg">
		                    	</div>
		                		<span class="white-text name"><?php echo $nama; ?><i class="material-icons left">account_circle</i></span>
		                	</div>
		                </li>               
		                <li><div class="divider" style="margin-top:15%;"></div></li>
		                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>
						<li><a href="tambah_barang.php" class="collapsible-header">Tambah Data Barang<i class="material-icons">edit</i></a></li>
						<li><a href="data_barang.php" class="collapsible-header">Edit Data Barang<i class="material-icons">edit</i></a></li>
						<li><a href="gudang_barang.php" class="collapsible-header">Gudang Barang<i class="material-icons">person</i></a></li>
		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>
	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container">
				<div class="col s12 m12 l12 offset-l2"> <br>
					<!--kolom search-->
					<div class="col s12 m12 l12">
						<form name="cari" method="post" action="cari_barang.php" class="row">
	                    	<div class="e-input-field col s12 m12 l12">
	                    		<input type="text" name="cari" placeholder="Masukkan Nama Barang" class="validate" required title="Cari User">
	                    		<input type="submit" name="cari2" value="cari" class="btn right red darken-2"> 
	                    	</div>
						</form>
					</div>

					<!--table-->
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom header table-->
							<tr>
			                  <th hidden>ID</th>
                                <th>Nama Barang</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Stok</th>
				            </tr>
							

							<?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['id'];      
				                echo "<tr>";
			                    echo "<td hidden>".$user_data['id']."</td>";
				                echo "<td>".$user_data['nama_barang']."</td>";
				                echo "<td>".$user_data['harga_beli']."</td>";
				                echo "<td>".$user_data['harga_jual']."</td>";
			                    echo "<td>".$user_data['stok']."</td>"; 
							}

							?>
	
						</table>
					</div>
					
					<ul class="pagination">
						<?php
							if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
						?>
							<li class="disabled"><a href="#">First</a></li>
							<li class="disabled"><a href="#">&laquo;</a></li>
						<?php
							}else{ // Jika page bukan page ke 1
							$link_prev = ($page > 1)? $page - 1 : 1;
						?>
							<li><a href="gudang_barang.php?page=1">First</a></li>
							<li><a href="gudang_barang.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
						<?php
						}
						?>

						<!-- LINK NUMBER -->
						<?php
						// Buat query untuk menghitung semua jumlah data
						$result2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM gudang_barang");
						$get_jumlah = mysqli_fetch_array($result2);
						
						$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
						$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
						$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
						$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
						
						for($i = $start_number; $i <= $end_number; $i++){
						$link_active = ($page == $i)? 'class="active"' : '';
						?>

						<li<?php echo $link_active; ?>><a href="gudang_barang.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php
						}
						?>

						<?php
								// Jika page sama dengan jumlah page, maka disable link NEXT nya
								// Artinya page tersebut adalah page terakhir 
								if($page == $jumlah_page){ // Jika page terakhir
								?>
								<li class="disabled"><a href="#">&raquo;</a></li>
								<li class="disabled"><a href="#">Last</a></li>
								<?php
								}else{ // Jika Bukan page terakhir
								$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
								?>
								<li><a href="gudang_barang.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
								<li><a href="gudang_barang.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
								<?php
								}
						?>	
					</ul>
				</div>
			</div>
		</main>
        <!--end of content-->


	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>