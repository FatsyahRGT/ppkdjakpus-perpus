<!-- fungsi GET adalah untuk menagmbil nilai dari url lalu dijadikan sebagai parameter -->
<!-- fungsi POST adalah untuk mengambil nilai dari inputan user lalu diper ke database dan dijadikan paramater -->
<?php

if (isset($_GET['edit'])) {
    $id       = $_GET['edit'];
    $edit     = mysqli_query($koneksi, "SELECT * FROM buku WHERE id ='$id'"); //menampilkan data dari tebel yang dipilih
    $rowEdit  = mysqli_fetch_assoc($edit); //ambil data dari hasil query
}
if (isset($_POST['simpan'])) { //untuk menyetting tombol button bisa digunakkan untuk menginput data   
    $id = (isset($_GET['edit'])) ? $_GET['edit'] : '';
    //jika parameter edit ada maka update, selain itu maka tambah (else)
    $id_kategori  = $_POST['id_kategori']; //membuat queri untuk tiap judul form seperti 'nama_lengkap' yang ada di css html dan dagtabase 
    $judul        = $_POST['judul'];
    $jumlah       = $_POST['jumlah'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penulis      = $_POST['penulis'];



    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO buku (id_kategori, judul, jumlah, penerbit, tahun_terbit, penulis) VALUES ('$id_kategori', '$judul', '$jumlah', '$penerbit', '$tahun_terbit', '$penulis')");
        header("location:?pg=buku&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE buku SET id_kategori='$id_kategori',judul='$judul', jumlah='$jumlah', penerbit='$penerbit', tahun_terbit='$tahun_terbit', penulis='$penulis' WHERE id='$id'");
        header("location:?pg=buku&ubah=berhasil"); //location untuk menuju halaman yang dituju dengan penggunaaan "pg"
    }
}


if (isset($_GET['delete'])) { //seperti biasa untuk fungsi if isset adalah untuk mensetting tombol tombol supaya bekerja sesuai perintah
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id = '$id'");
    header("location:?pg=buku&hapus=berhasil");
}


$kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data Buku</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Buku</label>
                            <select name="id_kategori" id="" class="form-control">
                                <option value="">Pilih Kategori Buku</option>
                                <?php while ($rowKategori = mysqli_fetch_assoc($kategori)) : ?>
                                    <option <?= isset($rowEdit['id_kategori']) ? ($rowEdit['id_kategori'] == $rowKategori['id']) ? 'selected' : '' : '' ?> value="<?= $rowKategori['id'] ?>"><?= $rowKategori['nama_kategori'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input value="<?php echo ($rowEdit['judul'] ?? '') ?>" type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah</label>
                            <input value="<?php echo ($rowEdit['jumlah'] ?? '') ?>" type="text" class="form-control" name="jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Penerbit</label>
                            <input value="<?php echo ($rowEdit['penerbit'] ?? '') ?>" type="text" class="form-control" name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tahun Terbit</label>
                            <input value="<?php echo ($rowEdit['tahun_terbit'] ?? '') ?>" type="text" class="form-control" name="tahun_terbit">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Penulis</label>
                            <input value="<?php echo ($rowEdit['penulis'] ?? '') ?>" type="text" class="form-control" name="penulis">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                        </div>
                        <!-- ini tombol button -->
                        <!-- label berfungsi untuk pemberian judul pada form -->
                    </form>
                </div>
            </div>
        </div>
    </div>