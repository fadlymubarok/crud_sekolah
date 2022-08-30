<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Siswa</h1>
    </div>

    <form action="<?= base_url('siswa/store') ?>" method="post">
        <div class="card p-3">
            <div class="d-flex">
                <div class="form-group w-50 mr-2">
                    <label for="nama_siswa">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_siswa">
                    <div class="text-danger"><?= form_error('nama_siswa'); ?></div>
                </div>
                <div class="form-group w-50">
                    <label for="tgl_lahir_siswa">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir_siswa">
                    <div class="text-danger"><?= form_error('tgl_lahir_siswa'); ?></div>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-50 mr-2">
                    <label for="alamat_siswa">Alamat Siswa</label>
                    <textarea name="alamat_siswa" class="form-control" cols="10" rows="5"></textarea>
                    <div class="text-danger"><?= form_error('alamat_siswa'); ?></div>
                </div>
                <div class="form-group w-50">
                    <label for="kelas_id">Kelas</label>
                    <select class="form-control" name="kelas_id">
                        <option value="">-- Pilih kelas --</option>
                        <?php foreach ($kelas->result() as $row) : ?>
                            <option value="<?= $row->id ?>"><?= $row->nama_kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="text-danger"><?= form_error('kelas_id'); ?></div>
                </div>
            </div>

            <div class="form-group">
                <a href="<?= base_url('siswa') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>