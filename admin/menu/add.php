<?php
session_start();
require("../../mainconfig.php");
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
		if (isset($_POST['add'])) {
			$nama = $_POST['nama'];
			$nohp = $_POST['nohp'];
			$namabuku = $_POST['namabuku'];
			$tanggal_pinjam = $_POST['tanggal_pinjam'];
			$tanggal_pengembalian = $_POST['tanggal_pengembalian'];
			$status = $_POST['status'];
			if (empty($nama)) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
			} else if (empty($nohp)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
			} else {
				$insert_news = mysqli_query($db, "INSERT INTO perpustakaan (nama, nohp, namabuku, tanggal_pinjam, tanggal_pengembalian, status ) VALUES ('$nama', '$nohp', '$namabuku', '$tanggal_pinjam', '$tanggal_pengembalian', 'Berhasil Dipinjam')");
				if ($insert_news == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> Buku berhasil ditambahkan";
				} else {
					$msg_type = "error";
					$msg_content = "<b>Gagal:</b> Error system.";
				}
			}
		}

	include("../../lib/header.php");
?>

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title"></h4>
                            </div>
                        </div>
								<div class="row">
									<div class="col-md-12">
								<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Data</h3> 
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
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="col-md-2 control-label">Nama</label>
												<div class="col-md-10">
													<input type="text" name="nama" class="form-control" placeholder="Masukan Nama Peminjam">
												</br></div>
													<label class="col-md-2 control-label">No Handphone</label>
												<div class="col-md-10">
													<input type="text" name="nohp" class="form-control" placeholder="6282240322284">
										</br></div>
													<label class="col-md-2 control-label">Nama Buku</label>
												<div class="col-md-10">
													<input type="text" name="namabuku" class="form-control" placeholder="Masukan Nama Buku">
										</br></div>
													<label class="col-md-2 control-label">Tanggal Pinjam</label>
													<div class="col-md-10">
												<input type="text" name="tanggal_pinjam" class="form-control" placeholder="yyyy-mm-dd">
										</br></div>
													<label class="col-md-2 control-label">Tanggal Pengembalian</label>
												<div class="col-md-10">
													<input type="text" name="tanggal_pengembalian" class="form-control" placeholder="yyyy-mm-dd">
												</br>

</br>

								<a href="<?php echo $cfg_baseurl; ?>admin/data.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="add">Tambah</button>
											</div>
										</form>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
	include("../../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>