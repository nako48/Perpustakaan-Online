<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}
} else {
    
if (isset($_POST['login'])) {
    $post_username = mysqli_real_escape_string($db, trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'])))));
    $post_password = mysqli_real_escape_string($db, trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'])))));
	if (empty($post_username) || empty($post_password)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal:</b> Mohon mengisi semua input dengan benar.";
	} else {
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username' AND password = '$post_password'");
		if (mysqli_num_rows($check_user) == 0) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Username atau password salah.";
		} else {
			$data_user = mysqli_fetch_assoc($check_user);
			if ($data_user['status'] == "Suspended") {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Akun nonaktif.";
			} else {
				$_SESSION['user'] = $data_user;
				header("Location: ".$cfg_baseurl);
			}
		}
	}
}
}

include("lib/header.php");
if (isset($_SESSION['user'])) {
?>
                          <div class="row">
							<div class="col-md-8">
									<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-info-circle"></i> Info Data:</h3> 
                                    </div> 
                                    <div class="panel-body">
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
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$check_news = mysqli_query($db, "SELECT * FROM perpustakaan ORDER BY id DESC LIMIT 5");
													$no = 1;
													while ($data_news = mysqli_fetch_assoc($check_news)) {
													?>
													<tr>
														<th scope="row"><?php echo $no; ?></th>
														<td><?php echo $data_news['nama']; ?></td>
														<td><?php echo $data_news['nohp']; ?></td>
														<td><?php echo $data_news['namabuku']; ?></td>
														<td><?php echo $data_news['tanggal_pinjam']; ?></td>
														<td><?php echo $data_news['tanggal_pengembalian']; ?></td>
														<td><?php echo $data_news['status']; ?></td>
													</tr>
													<?php
													$no++;
													}
													?>
												</tbody>
											</table>
										</div>
                                   </div>
								</div>
							</div>
							<div class="col-md-4">
									<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-user"></i> Detail Akun</h3> 
                                    </div> 
                                    <div class="panel-body">
										<div class="table-responsive">
                                              <table class="table table-bordered table-hover">
												<tbody>
													<tr>
														<td><b>Username</b></td>
														<td><?php echo $data_user['username']; ?></td>
													</tr>
													<tr>
														<td><b>Tanggal Daftar</b></td>
														<td><?php echo $data_user['registered']; ?></td>
													</tr>
													<tr>
														<td><b>Status</b></td>
														<td><?php echo $data_user['status']; ?></td>
													</tr>
													<?php
echo "<tr>
														<td><b>Waktu</b></td> <td>" . date("Y-m-d h:i:sa") . "<br></tr>";
?>
														<?php echo $tgl; ?></div>
														</td>														
													</tr>
												</tbody>
											</table>
		</div>		
	</div>
	
</footer>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
								</div>
							</div>
						</div>
<?php
} else {
?>
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-user"></i> Administrator Login</h3> 
                                    </div> 
                                    <div class="panel-body">
									    <?php 
										if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>

											<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username" title="Isi Username"/>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password" title="Isi Kata Sandi"/>
												</div>
											</div>
											<button type="submit" class="pull-right btn btn-primary btn-rounded waves-effect waves-light m-b-5" name="login">Masuk</button>
										</form>
										<div class="clearfix"></div>
									</div>
									<div class="panel-footer">
									</div>
								</div>
							</div>
								<div class="col-md-6">
								<div class="panel panel-border panel-primary">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><i class="fa fa-phone"></i> Contact</h3> 
                                    </div> 
                                    <div class="panel-body">
                                        <center>
                                        <a href="https://github.com/nako48" class="btn btn-primary"><i class="fa fa-github"></i> Github </a>
										<a href="https://facebook.com/nako48.jp" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook </a>  						
  										<a href="https://twitter.com/apay_12" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter </a>
								</div>
							</div>
						</div>
</section>
            </div>
        </div>
    </div>


<?php
}
include("lib/footer.php");
?>