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
				if (isset($_POST['edit'])) {
					$post_status = $_POST['status'];
					$post_password = $_POST['password'];
					$post_balance = $_POST['balance'];
					$post_level = $_POST['level'];
					if (empty($post_password)) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
					} else if ($post_level != "Member" AND $post_level != "Reseller" AND $post_level != "Admin") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
					} else if ($post_status != "Active" AND $post_status != "Suspended") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
					} else {
						$update_user = mysqli_query($db, "UPDATE users SET password = '$post_password', balance = '$post_balance', level = '$post_level', status = '$post_status' WHERE username = '$post_username'");
						if ($update_user == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Pengguna berhasil diubah.<br /><b>Username:</b> $post_username<br /><b>Password:</b> $post_password<br /><b>Level:</b> $post_level<br /><b>Status:</b> $post_status<br /><b>Saldo:</b> Rp. ".number_format($post_balance,0,',','.');
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
						}
					}
				}
				$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
				$datadb_user = mysqli_fetch_assoc($checkdb_user);
				include("../../lib/header.php");
?>

                        <!-- Page-Title -->
                        <div class="row">
                        </div> 
								<div class="row">
									<div class="col-md-12">
								<div class="panel panel-color panel-custom">
									<div class="panel-heading">
										<h3 class="panel-title"><i class="icon-user"></i> Ubah Pengguna</h3>
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
											<form class="form-horizontal" method="POST">
												<fieldset>
													<div class="form-group">
														<label class="form-label">Username</label>
															<input type="text" class="form-control" name="username" value="<?php echo $datadb_user['username']; ?>" readonly>
														</div>
													<div class="form-group">
														<label class="form-label">Password</label>
															<input type="text" class="form-control" name="password" value="<?php echo $datadb_user['password']; ?>">
														</div>
													<div class="form-group">
														<label class="form-label">Saldo</label>
															<input type="number" class="form-control" name="balance" value="<?php echo $datadb_user['balance']; ?>">
													</div>
													<div class="form-group">
														<label class="form-label">Level</label>
															<select class="form-control" name="level">
																<option value="Member" <?php if ($datadb_user['level'] == "Member") { echo "selected"; } ?>>Member <?php if ($datadb_user['level'] == "Member") { echo "(Terpilih)"; } ?></option>
																<option value="Reseller" <?php if ($datadb_user['level'] == "Reseller") { echo "selected"; } ?>>Reseller <?php if ($datadb_user['level'] == "Reseller") { echo "(Terpilih)"; } ?></option>
																<option value="Admin" <?php if ($datadb_user['level'] == "Admin") { echo "selected"; } ?>>Admin <?php if ($datadb_user['level'] == "Admin") { echo "(Terpilih)"; } ?></option>
															</select>
														</div>
													<div class="form-group">
														<label class="form-label">Status</label>
															<select class="form-control" name="status">
																<option value="Active" <?php if ($datadb_user['status'] == "Active") { echo "selected"; } ?>>Active <?php if ($datadb_user['status'] == "Active") { echo "(Terpilih)"; } ?></option>
																<option value="Suspended" <?php if ($datadb_user['status'] == "Suspended") { echo "selected"; } ?>>Suspended <?php if ($datadb_user['status'] == "Suspended") { echo "(Terpilih)"; } ?></option>
															</select>
														</div>
														<button type="submit" class="btn btn-info" name="edit">Ubah</button>
														<button type="reset" class="btn btn-warning">Ulangi</button>
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