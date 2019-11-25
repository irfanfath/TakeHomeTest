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
	<link href="./css/style.css" rel="stylesheet">
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
	    				<a class="page-title">Data Barang</a>
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
		<main>
			<div class="row container">
				<div class="col s12 m12 l12 offset-l2"> <br>
					<!--kolom search-->
					<div class="col s12 m12 l12">
						<form name="cari" method="post" action="cari_barang.php" class="row">
	                    	<div class="e-input-field col s12 m12 l12">
	                    		<input type="text" name="cari" placeholder="Masukkan Nama Barang" class="validate" required title="Cari Barang">
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
							  	<th>Gambar Barang</th>
								<th>Nama Barang</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Stok</th>
								<th>Pengaturan</th>
				            </tr>

							<?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['id'];      
				                echo "<tr>";
								echo "<td hidden>".$user_data['id']."</td>";
								echo "<td><img src='images/".$user_data['gambar_barang']."' width='100' height='100'></td>";
				                echo "<td>".$user_data['nama_barang']."</td>";
				                echo "<td>".$user_data['harga_beli']."</td>";
				                echo "<td>".$user_data['harga_jual']."</td>";
			                    echo "<td>".$user_data['stok']."</td>"; 
				                echo "<td> <a href='edit_barang.php?id=$user_data[id]' style='text-decoration: none;'><i class='material-icons' title='Edit $test'>mode_edit</i></a> | <a data-id='1' class='hapus' href='hapus_barang.php?id=$user_data[id]' style='text-decoration: none;'><i class='material-icons' title='Hapus $test'>delete</i></a> </td></tr>";  
				            }

							?>

						</table>

					</div>
				</div>
			</div>
		</main>
        <!--end of content-->
	</div>

		<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/materialize.min.js"></script>
		<script>
        $(".hapus").click(function () {
        var jawab = confirm("Anda Yakin Ingin Menghapus Barang ?");
        if (jawab === true) {
        // konfirmasi
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post('delete.php', {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                hapus = false;
            }
        } else {
            return false;
        }
        });
    	</script>

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