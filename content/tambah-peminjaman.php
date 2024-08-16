<!-- fungsi GET adalah untuk menagmbil nilai dari url lalu dijadikan sebagai parameter -->
<!-- fungsi POST adalah untuk mengambil nilai dari inputan user lalu diper ke database dan dijadikan paramater -->
<?php

if (isset($_GET['detail'])) {
    //DATA PEMINJAM
    $id       = $_GET['detail'];
    $detail     = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, peminjaman.*, user.nama_lengkap FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota LEFT JOIN user ON user.id = peminjaman.id_user WHERE peminjaman.id ='$id'"); //menampilkan data dari tebel yang dipilih
    $rowDetail  = mysqli_fetch_assoc($detail); //ambil data dari hasil query

    // menghitung durasi peminjaman
    $tanggal_pinjam = $rowDetail['tgl_pinjam'];
    $tanggal_kembali = $rowDetail['tgl_kembali'];

    $date_pinjam = new DateTime($tanggal_pinjam);
    $date_kembali = new DateTime($tanggal_kembali);
    $interval = $date_pinjam->diff($date_kembali);

    echo "Durasi buku yang di pinjam selama " . $interval->days . "hari";

    //DATA BUKU YANG DIPINJAM
    $queryDetail = mysqli_query($koneksi, "SELECT * FROM detail_peminjaman LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku LEFT JOIN kategori ON kategori.id = buku.id_kategori  WHERE id_peminjaman='$id'");
}
if (isset($_POST['simpan'])) {  //untuk menyetting tombol button bisa digunakkan untuk menginput data   

    $id = (isset($_GET['edit'])) ? $_GET['edit'] : '';
    //jika parameter edit ada maka update, selain itu maka tambah (else)
    $kode_transaksi = $_POST['kode_transaksi'];
    $id_anggota = $_POST['id_anggota'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam']; //membuat queri untuk tiap judul form seperti 'nama_lengkap' yang ada di css html dan dagtabase 
    $tgl_kembali = $_POST['tgl_kembali'];
    $id_kategori = $_POST['id_kategori'];

    $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (kode_transaksi, id_anggota, id_user, tgl_pinjam, tgl_kembali, status) VALUES ('$kode_transaksi', '$id_anggota', '$id_user', '$tgl_kembali', '$tgl_pinjam','1')");
    if ($insert) {
        $id_peminjam = mysqli_insert_id($koneksi);
        foreach ($id_kategori as $key => $value) {
            $id_kategori = $_POST['id_kategori'][$key];
            $id_buku = $_POST['id_buku'][$key];
            $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, id_kategori) VALUES ('$id_peminjam', '$id_kategori', '$id_buku')");
            header("location:?pg=peminjaman&tambah=berhasil");
        }
    } //else {
    //     $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap',email='$email', id_level='$id_level',password='$password' WHERE id='$id'");
    //     header("location:?pg=user&ubah=berhasil"); //location untuk menuju halaman yang dituju dengan penggunaaan "pg"
    // }
}


if (isset($_GET['delete'])) { //seperti biasa untuk fungsi if isset adalah untuk mensetting tombol tombol supaya bekerja sesuai perintah
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id =  '$id'");
    header("location:?pg=peminjaman&hapus=berhasil");
}

$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
// KODE TRANSAKSI
$queryKodeTrans = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$rowKodeTrans = mysqli_fetch_assoc($queryKodeTrans);
$no_urut = $rowKodeTrans['id_transaksi'];
$no_urut++;
//"SELECT max(id) as id_transaksi FROM peminjaman"); logic untuk mengambil nilai paling besar dari max
$kode_transaksi = "PJ" . date("d m Y") . sprintf("%03s", $no_urut);

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");

?>
<?php if (isset($_GET['detail'])): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sl-12">
                <div class="card">
                    <div class="card-header">Detail Transaksi Peminjaman</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Kode Transaksi</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo $rowDetail['kode_transaksi'] ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Tanggal Pinjam</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo date('D, d M Y', strtotime($rowDetail['tgl_pinjam'])) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Tanggal kembali</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo date('D, d M Y', strtotime($rowDetail['tgl_kembali'])) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="">Durasi Pinjam</label>
                                    </div>
                                    <div class="col-sm-8">
                                        Total Hari
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Nama Anggota</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo $rowDetail['nama_anggota'] ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Nama Petugas</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo $rowDetail['nama_lengkap'] ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Status</label>
                                    </div>
                                    <div div class="col-sm-8">
                                        <?php echo getStatus($rowDetail['status'])  ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- table -->
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Kategori Buku</th>
                                <th>Judul Buku</th>
                            </tr>
                            <?php $no = 1;
                            while ($rowDetail = mysqli_fetch_assoc($queryDetail)): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td></td>
                                    <td><?php echo $rowDetail['judul'] ?></td>
                                </tr>
                            <?php endwhile ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sl-12">
                <div class="card">
                    <div class="card-header">Detail Transaksi Peminjaman</div>
                    <div class="card-body">
                        <!-- membuat formulir atau form -->
                        <form action="" method="post">
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Kode Transaksi</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="kode_transaksi" value="<?php echo ($kode_transaksi ?? '') ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Nama Anggota</label>
                                </div>
                                <div class="col-sm-3">
                                    <select name="id_anggota" id="" class="form-control">
                                        <option value="">Pilih Anggota</option>
                                        <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)) : ?>
                                            <option value="<?php echo $rowAnggota['id'] ?>"><?php echo $rowAnggota['nama_lengkap'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal Pinjam</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tgl_pinjam">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal kembali</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tgl_kembali">
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-2">
                                    <label for="">Petugas</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="" value="<?php echo ($_SESSION['NAMA_LENGKAP'] ?? '') ?>">
                                    <input type="hidden" name="id_user" value="<?php echo ($_SESSION['ID_USER'] ?? '') ?>">
                                </div>
                            </div>

                            <!-- get data kategori buku dan buku -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Kategori Buku</label>
                                </div>
                                <div class="col-sm-3">
                                    <select id="id_kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)) : ?>
                                            <option value="<?php echo $rowKategori['id'] ?>"><?php echo $rowKategori['nama_kategori'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Nama Buku</label>
                                </div>
                                <div class="col-sm-3">
                                    <select name="id_buku" id="id_buku" class="form-control">
                                        <option value="">Pilih Buku</option>

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="tahun_terbit">
                            <div class="mt-5 mb-5">
                                <div align="right" class="mb-3">
                                    <button type="button" id="tambah-row" class="btn btn-primary tambah row">
                                        Tambah
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Tahun Terbit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>