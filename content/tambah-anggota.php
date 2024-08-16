<!-- fungsi GET adalah untuk menagmbil nilai dari url lalu dijadikan sebagai parameter -->
<!-- fungsi POST adalah untuk mengambil nilai dari inputan user lalu diper ke database dan dijadikan paramater -->
<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id ='$id'" ); //menampilkan data dari tebel yang dipilih
    $rowEdit = mysqli_fetch_assoc($edit); //ambil data dari hasil query
}
if (isset($_POST['simpan'])) { //untuk menyetting tombol button bisa digunakkan untuk menginput data   
    $id = (isset($_GET['edit'])) ? $_GET['edit'] : '';
    //jika parameter edit ada maka update, selain itu maka tambah (else)
    $nisn          = $_POST['nisn']; //membuat queri untuk tiap judul form seperti 'nama_lengkap' yang ada di css html dan dagtabase 
    $nama_lengkap  = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp       = $_POST['no_telp'];
    $alamat        = $_POST['alamat'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO anggota (nisn, nama_lengkap, jenis_kelamin, no_telp, alamat) VALUES ('$nisn', '$nama_lengkap', '$jenis_kelamin', '$no_telp', '$alamat')");
    } else{
        $update = mysqli_query($koneksi, "UPDATE anggota SET nisn='$nisn',nama_lengkap='$nama_lengkap',jenis_kelamin='$jenis_kelamin',no_telp='$no_telp',alamat='$alamat' WHERE id='$id'");
    }
    header("location:?pg=anggota&tambah=berhasil"); //location untuk menuju halaman yang dituju dengan penggunaaan "pg"
}

if (isset($_GET['delete'])) { //seperti biasa untuk fungsi if isset adalah untuk mensetting tombol tombol supaya bekerja sesuai perintah
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id = '$id'");
    header("location:?pg=anggota&hapus=berhasil");
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data Anggota</div>
                <div class="card-body">
                    <!-- membuat formulir atau form -->
                    <form action="" method="post">
                        <!-- method="post" artinya untuk mengirim inputan data dari user ke database agar terposting ke database. dan jika get hanya diambil ke url, kurang lebih mirip insert -->

                        <div class="mb-3">
                            <label for="" class="form-label">NISN</label>
                            <input value="<?php echo ($rowEdit['nisn'] ?? '')?>" type="text" class="form-control" name="nisn">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input value="<?php echo ($rowEdit['nama_lengkap'] ?? '')?>" type="text" class="form-control" name="nama_lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">No. Telp</label>
                            <input value="<?php echo ($rowEdit['no_telp'] ?? '')?>" type="number" class="form-control" name="no_telp">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" <?= isset($rowEdit['jenis_kelamin']) && $rowEdit['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= isset($rowEdit['jenis_kelamin']) && $rowEdit['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" id="" class="form-control"><?php echo ($rowEdit['alamat']??'')?></textarea>
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