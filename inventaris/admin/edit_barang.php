<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM gudang_barang ORDER BY nama_barang DESC");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

?>
<?php
// include database connection file
include_once("../config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{ 
  $id = $_POST['id'];
  $nama_barang=$_POST['nama_barang'];
  $harga_beli=$_POST['harga_beli'];
  $harga_jual=$_POST['harga_jual'];
  $stok=$_POST['stok'];
    
  // update user data
  $result = mysqli_query($koneksi, "UPDATE gudang_barang SET nama_barang='$nama_barang',harga_beli='$harga_beli',harga_jual='$harga_jual',stok='$stok' WHERE id=$id");
//   $result2 = mysqli_query($koneksi, "UPDATE tambah_barang SET nama_barang='$nama_barang',harga_beli='$harga_beli',harga_jual='$harga_jual',stok='$stok' WHERE id=$id");
  
  // Redirect to homepage to display updated user in list
  header("Location: data_barang.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "SELECT * FROM gudang_barang WHERE id=$id");
 
while($user_data = mysqli_fetch_array($result))
{
  $nama_barang = $user_data['nama_barang'];
  $harga_beli = $user_data['harga_beli'];
  $harga_jual = $user_data['harga_jual'];
  $stok = $user_data['stok'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.ico">
	<!--Import Google Icon Font-->
    <link href="../fonts/material.css" rel="stylesheet">
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
	    				<a class="page-title">Edit Barang Masuk</a>
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

		                <li>
		                	<a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
		                	<div class="collapsible-body">
		                		<ul>
									<li><a href="data_barang.php">Edit Barang</a></li>
									<li><a href="gudang_barang.php">Gudang Barang</a></li>
								</ul>
							</div>
		                </li>

		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container">
				<div class="col s12 m12 l10 offset-l3"> <br>

					<!--table-->
				<form action="" method="post" name="form1">
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom isian table-->
							<tr>
					        	<td>Nama Barang</td>
					        	<td><input type="text" name="nama_barang" value=<?php echo $nama_barang; ?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Harga Beli</td>
					        	<td><input type="text" name="harga_beli" value=<?php echo $harga_beli;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Harga Jual</td>
					        	<td><input type="text" name="harga_jual" value=<?php echo $harga_jual;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Stok</td>
					        	<td><input type="text" name="stok" value=<?php echo $stok;?>></td>
					      	</tr>
					      	<tr>
				            	<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				            </tr>
					      	</table>
					      	<table>
				            <tr>
				            	<th>
				            		<input type="submit" name="update" value="Edit Barang" class="right waves-effect waves-light btn green darken-2" style="float: left;">
				            	</th>
				            	<th style="width: 1%;">
				            		<a href="data_barang.php"><input type="button" value="Kembali" class="right waves-effect waves-light btn red darken-2"></a> 
				            	</th>
				            </tr>
				        </table>
					</div>
				</form>
				</div>
			</div>
		</main>
        <!--end of content-->

	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	    	$('.collapsible').collapsible();
	    	$(".button-collapse").sideNav();
		});
	</script>
</body>
</html>