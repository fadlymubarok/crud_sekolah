<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kelas</h1>
    </div>

    <form action="<?= base_url('kelas/update/' . $kelas->id) ?>" method="post">
        <div class="card p-3 col-lg-6">
            <div class="form-group">
                <label for="jurusan_id">Nama Jurusan</label>
                <select class="form-control" name="jurusan_id">
                    <option value="">-- Pilih jurusan --</option>
                    <?php foreach ($jurusan->result() as $row) : ?>
                        <option value="<?= $row->id ?>" <?= ($kelas->jurusan_id == $row->id) ? 'selected' : '' ?>>
                            <?= $row->nama_jurusan; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="text-danger"><?= form_error('jurusan_id'); ?></div>
            </div>
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas</label>
                <input type="text" class="form-control" name="nama_kelas" value="<?= $kelas->nama_kelas ?>">
                <div class="text-danger"><?= form_error('nama_kelas'); ?></div>
            </div>

            <div class="form-group">
                <label for="guru_id">Nama Guru</label>
                <select class="form-control" name="guru_id">
                    <option value="">-- Pilih guru --</option>
                    <?php foreach ($guru->result() as $row) : ?>
                        <option value="<?= $row->id ?>" <?= ($kelas->guru_id == $row->id) ? 'selected' : '' ?>><?= $row->nama_guru; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="text-danger"><?= form_error('guru_id'); ?></div>
            </div>

            <div class="form-group">
                <a href="<?= base_url() ?>kelas" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>