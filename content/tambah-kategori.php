<!-- fungsi GET adalah untuk menagmbil nilai dari url lalu dijadikan sebagai parameter -->
<!-- fungsi POST adalah untuk mengambil nilai dari inputan user lalu diper ke database dan dijadikan paramater -->
<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id ='$id'" ); //menampilkan data dari tebel yang dipilih
    $rowEdit = mysqli_fetch_assoc($edit); //ambil data dari hasil query
}
if (isset($_POST['simpan'])) { //untuk menyetting tombol button bisa digunakkan untuk menginput data   
    $id = (isset($_GET['edit'])) ? $_GET['edit'] : '';
    //jika parameter edit ada maka update, selain itu maka tambah (else)
    $nama_kategori = $_POST['nama_kategori']; //membuat queri untuk tiap judul form seperti 'nama_lengkap' yang ada di css html dan dagtabase 
    $keterangan = $_POST['keterangan'];
   
    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori, keterangan) VALUES ('$nama_kategori', '$keterangan')");
    } else{
        $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori',keterangan='$keterangan' WHERE id='$id'");
    }
    header("location:?pg=kategori&tambah=berhasil"); //location untuk menuju halaman yang dituju dengan penggunaaan "pg"
}

if (isset($_GET['delete'])) { //seperti biasa untuk fungsi if isset adalah untuk mensetting tombol tombol supaya bekerja sesuai perintah
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id = '$id'");
    header("location:?pg=kategori&hapus=berhasil");
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Kategori</div>
                <div class="card-body">
                    <!-- membuat formulir atau form -->
                    <form action="" method="post">
                        <!-- method="post" artinya untuk mengirim inputan data dari user ke database agar terposting ke database. dan jika get hanya diambil ke url, kurang lebih mirip insert -->

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input value="<?php echo ($rowEdit['nama_kategori'] ?? '')?>" type="text" class="form-control" name="nama_kategori">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input value="<?php echo ($rowEdit['keterangan'] ?? '')?>" type="text" class="form-control" name="keterangan">
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