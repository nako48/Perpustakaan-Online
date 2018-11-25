<?php
include 'mainconfig.php'
?>
<h3> Form Pencarian Dengan PHP</h3>

<form acton="index.php" method="get">
  <lable>Cari :</label>
  <input type="text" name="cari">
  <input type="submit" value="cari">
</form>

<?php
if(isset($_GET['cari'])){
  $cari = $_GET['cari'];
  echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>

<table border="1">
  <tr>
    <th>No</th>
    <th>Nama</th>
  </tr>
  <?php
  if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $data = mysqli_query($db,"SELECT * FROM perpustakaan WHERE nama like '%".$cari."%'");
  }
  $no = 1;
  while($d = mysqli_fetch_assoc($data)){
  ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['nama']; ?></td>
  </tr>
  <?php 
  } 
  ?>
</table>