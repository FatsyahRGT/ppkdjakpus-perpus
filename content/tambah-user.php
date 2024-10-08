<!-- fungsi GET adalah untuk menagmbil nilai dari url lalu dijadikan sebagai parameter -->
<!-- fungsi POST adalah untuk mengambil nilai dari inputan user lalu diper ke database dan dijadikan paramater -->
<?php

if (isset($_GET['edit'])) {
    $id       = $_GET['edit'];
    $edit     = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id'" ); //menampilkan data dari tebel yang dipilih
    $rowEdit  = mysqli_fetch_assoc($edit); //ambil data dari hasil query
}
if (isset($_POST['simpan'])) { //untuk menyetting tombol button bisa digunakkan untuk menginput data   
    $id = (isset($_GET['edit'])) ? $_GET['edit'] : '';
    //jika parameter edit ada maka update, selain itu maka tambah (else)
    $nama_lengkap = $_POST['nama_lengkap']; //membuat queri untuk tiap judul form seperti 'nama_lengkap' yang ada di css html dan dagtabase 
    $email        = $_POST['email'];
    $password     = sha1($_POST['password']);
    $id_level     = $_POST['id_level'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, email, password, id_level) VALUES ('$nama_lengkap', '$email', '$password', '$id_level')");
        header("location:?pg=user&tambah=berhasil");
    } else{
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap',email='$email', id_level='$id_level',password='$password' WHERE id='$id'");
        header("location:?pg=user&ubah=berhasil"); //location untuk menuju halaman yang dituju dengan penggunaaan "pg"
    }
    }
   

if (isset($_GET['delete'])) { //seperti biasa untuk fungsi if isset adalah untuk mensetting tombol tombol supaya bekerja sesuai perintah
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
    header("location:?pg=user&hapus=berhasil");
}

$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");


?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <!-- membuat formulir atau form -->
                    <form action="" method="post">
                        <!-- method="post" artinya untuk mengirim inputan data dari user ke database agar terposting ke database. dan jika get hanya diambil ke url, kurang lebih mirip insert -->
                        <div class="mb-3">
                            <label for="" class="form-label">Level</label>
                            <select name="id_level" id="" class="form-control">
                                <option value="">Pilih Level</option>
                                <?php while ($rowLevel = mysqli_fetch_assoc($level)) : ?>
                                    <option <?= isset($rowEdit['id_level'])?($rowEdit['id_level'] == $rowLevel['id']) ? 'selected' : '' :'' ?> 
                                        value="<?= $rowLevel['id'] ?>"><?= $rowLevel['nama_level'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input value="<?php echo ($rowEdit['nama_lengkap'] ?? '')?>" type="text" class="form-control" name="nama_lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input value="<?php echo ($rowEdit['email'] ?? '')?>" type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"> 
                            <!-- fungsinya "<input value=" adalah untuk ketika kita hendak mengisi formulir, sudah terisi secara default data dari database -->
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