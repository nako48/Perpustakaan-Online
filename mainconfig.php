<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// web
$cfg_webname = "Perpustakaan Online System"; // Judul / nama web
$cfg_baseurl = "http://localhost/nako/"; // Domain index / url utama web
$cfg_desc = "Perpustakaan Online "; // Deskripsi website
$cfg_author = "Arvan Apriyana"; // Nama author
$cfg_logo_txt = "Demo"; // Logo teks pada header
$cfg_about = "Demo";
// database
$db_server = "localhost";//biasanya pake localhost atau root
$db_user ="nakomedia";
$db_password = "kmz967zh72";
$db_name = "nakomedia";

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");

// require
require("lib/database.php");
require("lib/function.php");