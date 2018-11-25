<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['level'] != "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
		if (isset($_POST['delete'])) {
			$post_id = $_POST['id'];
			$checkdb_news =mysqli_query($db,"SELECT * FROM perpustakaan WHERE tanggal_pinjam like '%".$cari."%'");
			if (mysqli_num_rows($checkdb_news) == 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Berita tidak ditemukan.";
			} else {
				$delete_news = mysqli_query($db,"SELECT * FROM perpustakaan WHERE tanggal_pinjam like '%".$cari."%'");
				if ($delete_news == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> deleted.";
				}
			}
		}

	include("../lib/header.php");
?>

							<div class="row">
							<div class="col-md-12">
								<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-info-circle"></i> Daftar Data</h3> 
                                    </div> 
                                    <div class="panel-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
											<form acton="index.php" method="get">
  											<lable>Cari :</label>
  											<input type="text" name="cari" class="form-control" placeholder="yyyy-mm-dd">
  												</br>
								<a href="<?php echo $cfg_baseurl; ?>admin/data.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="add">Cari</button>
											</div>
										</form>
									<?php
if(isset($_GET['cari'])){
  $cari = $_GET['cari'];
  echo "</br></br><b>Hasil pencarian : ".$cari."</b>";
}
?>

									<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Nama</th>
														<th>No Handphone</th>
														<th>Nama Buku</th>
														<th>Tanggal Pinjam</th>
														<th>Tanggal Pengembalian</th>
														<th>Status Buku</th>
													</tr>
												</thead>
												<tbody>
												</br>
  <?php
  if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $data = mysqli_query($db,"SELECT * FROM perpustakaan WHERE tanggal_pinjam like '%".$cari."%'");
  }
  $no = 1;
  while($d = mysqli_fetch_assoc($data)){
  ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['nama']; ?></td>
    <td><?php echo $d['nohp']; ?></td>
    <td><?php echo $d['namabuku']; ?></td>
    <td><?php echo $d['tanggal_pinjam']; ?></td>
    <td><?php echo $d['tanggal_pengembalian']; ?></td>
    <td><?php echo $d['status']; ?></td>
  </tr>
  <?php 
  } 
  ?>
</table>
										</div>
                                                        <div aria-label="page list">
                                                        <p class="demo demo1"></p>
                                                        </div>
                                                          <div aria-label="page list">
                                                            <p class="demo demo2"></p>
                                                          </div>

                                                    </pre>
                                                    </div>
										</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
	include("../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>