<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Guru</h1>
    </div>

    <form action="<?= base_url('guru/update/' . $guru->id) ?>" method="post">
        <div class="card p-3 w-50">
            <div class="form-group">
                <label for="nama_guru">Nama guru</label>
                <input type="text" class="form-control" name="nama_guru" value="<?= $guru->nama_guru; ?>">
                <div class="text-danger"><?= form_error('nama_guru'); ?></div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_guru">Tanggal lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir_guru">
                <small class="text-secondary">* isi jika ingin diubah</small>
                <div class="text-danger"><?= form_error('tanggal_lahir_guru'); ?></div>
            </div>
            <div class="form-group">
                <label for="alamat_guru">Alamat guru</label>
                <textarea name="alamat_guru" class="form-control" cols="30" rows="10"><?= $guru->alamat_guru; ?></textarea>
                <div class="text-danger"><?= form_error('alamat_guru'); ?></div>
            </div>

            <div class="form-group">
                <a href="<?= base_url('guru') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>