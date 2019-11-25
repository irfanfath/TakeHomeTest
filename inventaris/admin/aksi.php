 <?php
if (isset($_POST['tambah']))
{
  $harga_beli=$_POST['harga_beli'];
    if (!is_numeric($harga_beli))
    {
      echo 'Input Harga Harus Angka';
    }
    else
   {
      echo 'Rp.'.$harga_beli;
   }
}
?>