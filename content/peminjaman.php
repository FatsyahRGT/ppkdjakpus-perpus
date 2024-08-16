<?php
$queryPinjam = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, user.nama_lengkap, peminjaman.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota LEFT JOIN user ON user.id = peminjaman.id_user WHERE deleted_at = 0 ORDER BY id DESC"); 
//desc artinya mengurutkan dari nilai terbesar ke terkecil dan $queryUser adalah variabel buatan kita di awal konfig
// LEFT JOIN level ON level.id = user.id_level sebagai penjoinan row
// "."sebagai penghubung tabel dan kolom
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sl-12">
            <div class="card">
                <div class="card-header">Transaksi Peminjaman</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-peminjaman" class="btn btn-primary">Tambah</a>
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
                                <th>Kode Transaksi</th>
                                <th>Anggota</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Petugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($queryPinjam)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['kode_transaksi'] ?></td>
                                    <td><?php echo $row['nama_anggota'] ?></td>
                                    <td><?php echo $row['tgl_pinjam'] ?></td>
                                    <td><?php echo $row['tgl_kembali'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['nama_lengkap'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-peminjaman&detail=<?php echo $row['id'] ?>" class="btn btn-sm btn-success">Detail</a>
                                        |
                                        <a onclick="return confirm('apakah anda yakin akan menghapus data ini??')" href="?pg=tambah-peminjaman&delete=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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