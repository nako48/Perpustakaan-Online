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
		if (isset($_GET['username'])) {
			$post_username = $_GET['username'];
			$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			$datadb_user = mysqli_fetch_assoc($checkdb_user);
			if (mysqli_num_rows($checkdb_user) == 0) {
				header("Location: ".$cfg_baseurl."admin/users.php");
			} else {
				include("../../lib/header.php");
?>

                        <!-- Page-Title -->
                        <div class="row">
                        </div> 
                        
									<div class="row">
									<div class="col-md-12">
								<div class="panel panel-color panel-custom">
									<div class="panel-heading">
										<h3 class="panel-title"><i class="fa fa-user"></i> Hapus Pengguna</h3>
									</div>
									<div class="panel-body">
											<legend>Hapus Pengguna</legend>
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
											<form class="form-horizontal" method="POST" action="<?php echo $cfg_baseurl; ?>admin/users.php">
												<fieldset>
													<div class="form-group">
														<label class="form-label">Username</label>
															<input type="text" class="form-control" name="username" value="<?php echo $datadb_user['username']; ?>" readonly>
														</div>
													<div class="form-actions">
														<button type="submit" class="btn btn-primary" name="delete">Hapus</button>
														<button type="reset" class="btn">Ulangi</button>
														<a href="<?php echo $cfg_baseurl; ?>admin/users.php" class="btn btn-success">Kembali</a>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
<?php
				include("../../lib/footer.php");
			}
		} else {
			header("Location: ".$cfg_baseurl."admin/users.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>