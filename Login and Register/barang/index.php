<?php
// Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbctraaudi1";

// Buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

// Jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {

    // Jika tombol edit diklik
    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $kode = mysqli_real_escape_string($koneksi, $_POST['tkode']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['tnama']);
        $asal = mysqli_real_escape_string($koneksi, $_POST['tasal']);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST['tjumlah']);
        $satuan = mysqli_real_escape_string($koneksi, $_POST['tsatuan']);
        $tanggal_diterima = mysqli_real_escape_string($koneksi, $_POST['ttanggal_diterima']);

        $update = mysqli_query($koneksi, "UPDATE tbarang SET kode='$kode', nama='$nama', asal='$asal', jumlah='$jumlah', satuan='$satuan', tanggal_diterima='$tanggal_diterima' WHERE id_barang='$id'");
        
        if ($update) {
            echo "<script>
                alert('Update data Sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Update data Gagal!');
                document.location='index.php';
            </script>";
        }

    } else {
        // Data akan disimpan baru
        $kode = mysqli_real_escape_string($koneksi, $_POST['tkode']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['tnama']);
        $asal = mysqli_real_escape_string($koneksi, $_POST['tasal']);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST['tjumlah']);
        $satuan = mysqli_real_escape_string($koneksi, $_POST['tsatuan']);
        $tanggal_diterima = mysqli_real_escape_string($koneksi, $_POST['ttanggal_diterima']);

        $simpan = mysqli_query($koneksi, "INSERT INTO tbarang (kode, nama, asal, jumlah, satuan, tanggal_diterima) VALUES ('$kode', '$nama', '$asal', '$jumlah', '$satuan', '$tanggal_diterima')");

        if ($simpan) {
            echo "<script>
                alert('Simpan data Sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Simpan data Gagal!');
                document.location='index.php';
            </script>";
        }
    }
}

// Deklarasi variabel untuk menampung data yang akan diedit
$vkode = "";
$vnama = "";
$vasal = "";
$vjumlah = "";
$vsatuan = "";
$vtanggal_diterima = "";

// Pengujian jika tombol edit/hapus diklik
if (isset($_GET['hal'])) {
    // Pengujian jika edit data
    if ($_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang = '$id'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // Jika data ditemukan, maka data di tampung ke dalam variabel
            $vkode = $data['kode'];
            $vnama = $data['nama'];
            $vasal = $data['asal'];
            $vjumlah = $data['jumlah'];
            $vsatuan = $data['satuan'];
            $vtanggal_diterima = $data['tanggal_diterima'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang='$id'");
        
        if ($hapus) {
            echo "<script>
                alert('Hapus data Sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Hapus data Gagal!');
                document.location='index.php';
            </script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTRAAUDI PHP & MySQL + Bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- awal container -->
    <div class="container">
        <h3 class="text-center">Data Inventaris</h3>
        <h3 class="text-center">Kantor Ngodingpintar</h3>

        <!-- awal row -->
        <div class="row">
            <!-- awal col -->
            <div class="col-md-8 mx-auto">
                <!-- awal card -->
                <div class="card text-center">
                    <div class="card-header bg-info text-light">
                        Form Input Data Barang
                    </div>
                    <div class="card-body">
                        <!-- Awal Form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" value="<?= htmlspecialchars($vkode) ?>" class="form-control" placeholder="Masukkan Kode Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" value="<?= htmlspecialchars($vnama) ?>" class="form-control" placeholder="Masukkan Nama Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Barang</label>
                                <select class="form-select" name="tasal">
                                    <option value="<?= htmlspecialchars($vasal) ?>"><?= htmlspecialchars($vasal) ?></option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Bantuan">Bantuan</option>
                                    <option value="Sumbangan">Sumbangan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?= htmlspecialchars($vjumlah) ?>" class="form-control" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan">
                                            <option value="<?= htmlspecialchars($vsatuan) ?>"><?= htmlspecialchars($vsatuan) ?></option>
                                            <option value="Unit">Unit</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Pack">Pack</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Diterima</label>
                                <input type="date" name="ttanggal_diterima" value="<?= htmlspecialchars($vtanggal_diterima) ?>" class="form-control">
                            </div>

                            <div class="text-center">
                                <hr>
                                <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                            </div>
                        </form>
                        <!-- Akhir Form -->
                    </div>
                    <div class="card-footer bg-info"></div>
                </div>
                <!-- akhir card -->
            </div>
            <!-- akhir col -->
        </div>
        <!-- akhir row -->

        <!-- awal card -->
        <div class="card mt-3">
            <div class="card-header bg-info text-light">
                Data Barang
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukkan kata kunci!">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                    </form>
                </div>

                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Asal Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Diterima</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    // Persiapan menampilkan data
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang ORDER BY id_barang DESC");
                    while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($data['kode']) ?></td>
                        <td><?= htmlspecialchars($data['nama']) ?></td>
                        <td><?= htmlspecialchars($data['asal']) ?></td>
                        <td><?= htmlspecialchars($data['jumlah']) ?> <?= htmlspecialchars($data['satuan']) ?></td>
                        <td><?= htmlspecialchars($data['tanggal_diterima']) ?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?= htmlspecialchars($data['id_barang']) ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?hal=hapus&id=<?= htmlspecialchars($data['id_barang']) ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="card-footer bg-info"></div>
        </div>
        <!-- akhir card -->
    </div>
    <!-- akhir container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
