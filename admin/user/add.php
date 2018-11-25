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
			$post_username = $_POST['username'];
			$post_password = $_POST['password'];
			$post_balance = $_POST['balance'];
			$post_level = $_POST['level'];

			$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			$datadb_user = mysqli_fetch_assoc($checkdb_user);
			if (empty($post_username) || empty($post_password)) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
			} else if ($post_level != "Member" AND $post_level != "Admin") {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
			} else if (mysqli_num_rows($checkdb_user) > 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Username $post_username sudah terdaftar dalam database.";
			} else {
				$post_api = random(20);
				$insert_user = mysqli_query($db, "INSERT INTO users (username, password, balance, level, registered, status, uplink) VALUES ('$post_username', '$post_password', '$post_balance', '$post_level', '$date', 'Active', '$sess_username')");
				if ($insert_user == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> Pengguna berhasil ditambahkan.<br /><b>Username:</b> $post_username<br /><b>Password:</b> $post_password<br /><b>Level:</b> $post_level<br /><b>Saldo:</b> Rp. ".number_format($post_balance,0,',','.');
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
                                        <h3 class="panel-title"><i class="fa fa-plus"></i> Add user</h3> 
                                    </div> 
                                    <div class="panel-body">
											<?php 
											if ($msg_type == "success") {
											?>
											<div class="alert bg-info">
												<i class="fa fa-check-circle"></i>
												<?php echo $msg_content; ?>
											</div>
											<?php
											} else if ($msg_type == "error") {
											?>
											<div class="alert bg-danger">
												<i class="fa fa-times-circle"></i>
												<?php echo $msg_content; ?>
											</div>
											<?php
											}
											?>
											<form class="form-horizontal" method="POST">
												<div class="form-group row">
							<label class="col-md-2 control-label">Level</label>
								<div class="col-md-10">
															<select class="form-control" name="level">
																<option value="Member">Member</option>
																<option value="Admin">Admin</option>
															</select>
														</div>
														</div>
													<div class="form-group row">
							<label class="col-md-2 control-label">Username</label>
								<div class="col-md-10">
															<input type="text" class="form-control" name="username" />
														</div>
														</div>
													<div class="form-group row">
							<label class="col-md-2 control-label">Password</label>
								<div class="col-md-10">
															<input type="text" class="form-control" name="password" />
														</div>
														</div>
														<button type="submit" class="pull-right btn btn-info" name="add">Tambah pengguna</button>
											</form>
											<div class="clearfix"></div>
										</div>
									</div>

<?php
	include("../../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>