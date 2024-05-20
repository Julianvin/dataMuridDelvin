<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
        }

        .btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <h2 class="text-center mb-4">Masukan Data Siswa</h2>
                    <form method="POST">
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama:</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Anda...">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rayon" class="col-sm-3 col-form-label">Rayon:</label>
                            <div class="col-sm-9">
                                <input type="text" name="rayon" class="form-control" id="rayon" placeholder="Masukkan Rayon Anda...">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-3 col-form-label">NIS:</label>
                            <div class="col-sm-9">
                                <input type="text" name="nis" class="form-control" id="nis" placeholder="Masukkan NIS Anda...">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="kirim" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</button>
                            <button type="submit" name="delete" class="btn btn-danger ms-2"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        session_start();

        if (!isset($_SESSION['dataSiswa'])) {
            $_SESSION['dataSiswa'] = array();
        }

        if (isset($_POST['delete'])) {
            session_unset();
        }

        if (isset($_POST['kirim'])) {
            if (!empty($_POST['nama']) && !empty($_POST['rayon']) && !empty($_POST['nis'])) {
                // Mendapatkan input dari form
                $nama = $_POST['nama'];
                $rayon = $_POST['rayon'];
                $nis = $_POST['nis'];

                // Memeriksa apakah data sudah ada dalam session
                $dataExists = false;
                foreach ($_SESSION['dataSiswa'] as $data) {
                    if ($data['nama'] === $nama && $data['rayon'] === $rayon && $data['nis'] === $nis) {
                        $dataExists = true;
                        break;
                    }
                }

                // Jika data belum ada, tambahkan ke session
                if (!$dataExists) {
                    $data = [
                        'nama' => $nama,
                        'rayon' => $rayon,
                        'nis' => $nis
                    ];
                    array_push($_SESSION['dataSiswa'], $data);
                }
            }
        }
        ?>


        <?php if (!empty($_SESSION['dataSiswa'])) : ?>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8">
                    <table class="table shadow table-striped table-hover rounded table-responsive text-center">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Rayon</th>
                                <th>NIS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['dataSiswa'] as $index => $value) : ?>
                                <tr>
                                    <td><?= $value['nama'] ?></td>
                                    <td><?= $value['rayon'] ?></td>
                                    <td><?= $value['nis'] ?></td>
                                    <td><a href="delete.php?i=<?= $index ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')"><button class="btn btn-danger"><i class="bi bi-trash2-fill"></i> Delete</button></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-6">
                    <div class="alert shadow alert-danger text-center" role="alert">
                        Tidak ada data yang terkirim!
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>