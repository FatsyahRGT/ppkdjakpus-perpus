<?php
$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC"); //desc artinya mengurutkan dari nilai terbesar ke terkecil dan $queryUser adalah variabel buatan kita di awal konfig
// $row
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data Anggota</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-anggota" class="btn btn-primary">Tambah</a>
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
                                <th>Nomor</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowAnggota['nisn'] ?></td>
                                    <td><?php echo $rowAnggota['nama_lengkap'] ?></td>
                                    <td><?php echo $rowAnggota['jenis_kelamin'] ?></td>
                                    <td><?php echo $rowAnggota['no_telp'] ?></td>
                                    <td><?php echo $rowAnggota['alamat'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-anggota&edit=<?php echo $rowAnggota['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                         |
                                        <a onclick="return confirm('apakah anda yakin akan menghapus data ini??')" 
                                        href="?pg=tambah-anggota&delete=<?php echo $rowAnggota['id'] ?>" 
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