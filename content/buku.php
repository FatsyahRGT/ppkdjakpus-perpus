<?php
$queryBuku = mysqli_query($koneksi, "SELECT kategori.nama_kategori, buku.* FROM buku LEFT JOIN kategori ON kategori.id = buku.id_kategori ORDER BY id DESC");
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Data Buku</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-buku" class="btn btn-primary">Tambah</a>
                    </div>
                    <?php if (isset($_GET['tambah'])) : ?>
                        <!-- arti isset = jika paramater tambah tidak kosong, maka memunculkan si alert, dan penggunaann iset kebanyakan untuk pemungsian tombol -->
                        <div class="alert alert-success">
                            Data Berhasil Ditambah
                        </div>
                    <?php endif ?>
                    <?php if (isset($_GET['hapus'])) : ?>
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
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Jumlah</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowBuku = mysqli_fetch_assoc($queryBuku)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowBuku['nama_kategori'] ?></td>
                                    <td><?php echo $rowBuku['judul'] ?></td>
                                    <td><?php echo $rowBuku['jumlah'] ?></td>
                                    <td><?php echo $rowBuku['penerbit'] ?></td>
                                    <td><?php echo $rowBuku['tahun_terbit'] ?></td>
                                    <td><?php echo $rowBuku['penulis'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-Buku&edit=<?php echo $rowBuku['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                        |
                                        <a onclick="return confirm('apakah anda yakin akan menghapus data ini??')" href="?pg=tambah-buku&delete=<?php echo $rowBuku['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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