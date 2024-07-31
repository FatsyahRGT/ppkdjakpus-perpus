<?php
$queryUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC"); //desc artinya mengurutkan dari nilai terbesar ke terkecil dan $queryUser adalah variabel buatan kita di awal konfig
// $row
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-user" class="btn btn-primary">Tambah</a>
                    </div>
                    <?php if(isset($_GET['tambah'])) : ?> 
                        <!-- arti isset = jika paramater tambah tidak kosong, maka memunculkan si alert, dan penggunaann iset kebanyakan untuk pemungsian tombol -->
                    <div class="alert alert-success">
                        Data Berhasil Ditambah
                    </div>
                    <?php endif ?>
                    <?php if(isset($_GET['hapus'])) : ?> 
                        <!-- arti isset = jika paramater tambah tidak kosong, maka memunculkan si alert, dan penggunaann iset kebanyakan untuk pemungsian tombol -->
                    <div class="alert alert-danger">
                        Data Berhasil Dihapus
                    </div>
                    <?php endif ?>
                    <!-- pembuatan tabel -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowUser = mysqli_fetch_assoc($queryUser)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowUser['nama_lengkap'] ?></td>
                                    <td><?php echo $rowUser['email'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-user&edit=<?php echo $rowUser['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                         |
                                        <a onclick="return confirm('apakah anda yakin akan menghapus data ini??')" 
                                        href="?pg=tambah-user&delete=<?php echo $rowUser['id'] ?>" 
                                        class="btn btn-sm btn-danger">Delete</a> 
                                        <!-- fungsi oneclick adalah untuk memberi peringatan apabila jika ingin menghapus data ada peringatan supaya tidak langsung terhapus -->
                                    </td>
                                    <td></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>