<div class="container-fluid">
    <div class="row">
        <?php require 'admin/template/menu.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Anggota</h1>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i> Tambah Anggota
                    </button>
                </div>
            </div>

            <?php if (isset($_SESSION['_flashdata'])): ?>
                <br>
                <?php foreach ($_SESSION['_flashdata'] as $key => $val): ?>
                    <?= get_flashdata($key); ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="table-responsive small">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM anggota a, jabatan j, user u WHERE a.jabatan_id = j.id AND a.user_id = u.id ORDER BY a.id DESC";
                        $result = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['jabatan']); ?></td>
                                <td><?= htmlspecialchars($row['username']); ?></td>
                                <td>
                                    <a href="index.php?page=anggota/edit&id=<?= $row['user_id']; ?>" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="fungsi/hapus.php?anggota=hapus&id=<?= $row['user_id']; ?>" onclick="return confirm('Hapus Data Jabatan?');" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal for adding anggota -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Form Anggota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="fungsi/tambah.php?anggota=tambah" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="col-form-label">Jabatan:</label>
                                    <select class="form-select" name="jabatan" id="jabatan" required>
                                        <option selected disabled>Pilih Jabatan</option>
                                        <?php
                                        $query2 = "SELECT * FROM jabatan ORDER BY jabatan ASC";
                                        $result2 = mysqli_query($koneksi, $query2);
                                        while ($row2 = mysqli_fetch_assoc($result2)):
                                        ?>
                                            <option value="<?= $row2['id']; ?>"><?= htmlspecialchars($row2['jabatan']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Jenis Kelamin:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" checked>
                                        <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat:</label>
                                    <textarea class="form-control" name="alamat" id="alamat" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="col-form-label">No Telepon:</label>
                                    <input type="number" name="no_telp" class="form-control" id="no_telp" required>
                                </div>
                                <hr class="border border-primary border-3 opacity-75">
                                <div class="mb-3">
                                    <label for="username" class="col-form-label">Username:</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="col-form-label">Level:</label>
                                    <select class="form-select" name="level" id="level" required>
                                        <option selected disabled>Pilih Level</option>
                                        <option value="user">User </option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fa fa-times" aria-hidden="true"></i> Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>