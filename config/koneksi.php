<?php
$host_koneksi = "localhost";
$username_koneksi = "root";
$password_koneksi = "";
$database_koneksi = "perpus";

$koneksi = mysqli_connect($host_koneksi, $username_koneksi, $password_koneksi, $database_koneksi); //mysqli_connect adalah library dari mysql lalu dengan memanggil variabel diatas, kita tidak perlu memanggil isi dari variabel tersebut

if (!$koneksi) {
    die("error mysqli". mysqli_connect_error($koneksi)); //fungsi die adalah menghentikan eksekusi skrip PHP dan menampilkan pesan ke pengguna & arti simbol "!" artinya tidak 
}