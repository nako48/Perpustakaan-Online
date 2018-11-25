<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}
}

include("lib/header.php");
?>
                        
							<div class="row">
							<div class="col-md-12">
								<div class="alert alert-icon bg-primary alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<i class="fa fa-info-circle"></i> Biaya Pendaftaran
							</div>
								<div class="col-md-6">
									<div class="white-box text-center bg-info" style="padding: 20px 0;">
										<img src="https://previews.123rf.com/images/provector/provector1501/provector150100144/35282212-Flat-Busness-Man-User-Profile-Avatar-in-Suit-icon-design-and-long-shadow-vector-illustration-for-web-Stock-Vector.jpg" class="img-thumbnail" style="width: 100px; border-radius: 50px;"><br />
										<h1 class="text-white text-uppercase"><i class="fa fa-dollar"></i> Free</h1>
										<p class="text-white text-uppercase"><i class="fa fa-user"></i> Member</p>
										<p class="fa fa-check"> Mendapat Mengakses Semua Layanan Kami</p><br>
										<p class="fa fa-check"> Dapat Mengakses API INTEGRATION</p><br>
										<p class="fa fa-check"> Topup Via Pulsa Rate 0.85</p><br>
										<p class="fa fa-check"> Slot Unlimited</p>										
											<center>
											<a href="https://48pedia.web.id/contact.php" class="btn btn-success btn-bordered waves-effect w-md waves-light"><i class="fa fa-user-plus"></i> Daftar Sekarang Juga!</button></a>
									</div>
								</div> <!-- end col -->
								
																<div class="col-md-6">
									<div class="white-box text-center bg-info" style="padding: 20px 0;">
										<img src="https://previews.123rf.com/images/provector/provector1501/provector150100144/35282212-Flat-Busness-Man-User-Profile-Avatar-in-Suit-icon-design-and-long-shadow-vector-illustration-for-web-Stock-Vector.jpg" class="img-thumbnail" style="width: 100px; border-radius: 50px;"><br />
										<h1 class="text-white text-uppercase"><i class="fa fa-dollar"></i> 75Rb</h1>
										<p class="text-white text-uppercase"><i class="fa fa-user"></i> Reseller</p>
										<p class="fa fa-check"> Mendapat Mengakses Semua Layanan Kami</p><br>
										<p class="fa fa-check"> Dapat Mengakses API INTEGRATION</p><br>
										<p class="fa fa-check"> Dapat Menambahkan Member</p><br>
										<p class="fa fa-check"> Dapat Melakukan Penjualan Saldo</p><br>	
										<p class="fa fa-check"> Topup Via Bank (Bonus Per 20Rb = 1000 Rupiah)</p><br>										
										<p class="fa fa-check"> Topup Via Pulsa Rate 0.85 (Bonus Per 20Rb = 500 Rupiah)</p><br>
										<p class="fa fa-check"> Slot 3</p>										
											<center>
											<a href="https://48pedia.web.id/contact.php" class="btn btn-success btn-bordered waves-effect w-md waves-light"><i class="fa fa-user-plus"></i> Daftar Sekarang Juga!</button></a>
									</div>
								</div> <!-- end col -->
							
						<!-- end row -->
													
								</div>
							</div>
						</div>
<?php
include("lib/footer.php");
?>