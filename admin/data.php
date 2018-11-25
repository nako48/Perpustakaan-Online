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
			$checkdb_news = mysqli_query($db, "SELECT * FROM perpustakaan WHERE id = '$post_id'");
			if (mysqli_num_rows($checkdb_news) == 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Berita tidak ditemukan.";
			} else {
				$delete_news = mysqli_query($db, "DELETE FROM perpustakaan WHERE id = '$post_id'");
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
// start paging config
$query_list = "SELECT * FROM perpustakaan ORDER BY id DESC"; // edit
$records_per_page = 10; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $data_show['nama']; ?></td>
														<td><?php echo $data_show['nohp']; ?></td>
														<td><?php echo $data_show['namabuku']; ?></td>
														<td><?php echo $data_show['tanggal_pinjam']; ?></td>
														<td><?php echo $data_show['tanggal_pengembalian']; ?></td>
														<td><?php echo $data_show['status']; ?></td>
														<td align="center">
														<a href="<?php echo $cfg_baseurl; ?>admin/menu/edit.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
														<a href="<?php echo $cfg_baseurl; ?>admin/menu/delete.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php
												$no++;
												}
												?>
												</tbody>
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