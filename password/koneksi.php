<?php
 // menyisipkan file class mikrotik php api
 include("routeros_api.class.php");

// KOFIGURASI

$config_nameserver = "refsinet.com"; // NAME SERVER HOTSPOT MIKROTIK

$config_emailserver = "refsisangkay@gmail.com"; // EMAIL PENGIRIM PEMBERITAHUAN
$config_emailpassword = "cmVmc2llbHpoYTA3"; // PASSWORD EMAIL di enskripsi dengan base64_encode()
 
 // membuat instance atau object dari class
 $API = new routerosAPI();
 
 // mendeklarasikan variable untuk koneksi ke mikrotik
 $mikrotik_hostname = "192.168.1.1";
 $mikrotik_username = "change_password"; // user hotspot
 $mikrotik_password = "refsi"; // password hotspot

 
 // membuat & mengecek koneksi ke router mikrotik
 if (!$API->connect($mikrotik_hostname, $mikrotik_username, $mikrotik_password))
 {
  die("Koneksi Gagal dilakukan!");
 }
?>