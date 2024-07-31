<?php
session_start();
include "config/koneksi.php";
//memanggil array sesion dari database
// echo "<h1>Selamat Datang" . (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') . "</h1>"; 
//cara mencegah error
//fungsi isset adalah shortcut logika if supaya ringkas yang jika dibahasakan "jika kosong"
// fungsi '.' (titik) adalah untuk menggabungkan string
// echo "<h1>Selamat Datang  {$_SESSION['NAMA_LENGKAP']} </h1>";// bisa menggunakkan kurung kurawal juga
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        nav.menu {
            background-color: white;
            box-shadow: 0 0 3px #000;
        }
    </style>
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="wrapper">
        <nav class="menu navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=user">User</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?pg=level">Level</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?pg=kategori">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>

<?php
if (isset($_GET['pg'])) {
    if (file_exists('content/' . $_GET['pg'] . '.php')) { //arti file exit adalah untuk menanyakan untuk ketersediaan file tersebut
        include 'content/' . $_GET['pg'] . '.php'; //artinya adalah mengecek jika ada file yang ekstensinya .php akan terekesekusi atau terpanggil
    } else {
        echo "not found";
    }
} else {
    include 'content/home.php';
}
?>

</div>
</body>

</html>