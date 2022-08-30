<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jurusan</h1>
    </div>

    <form action="<?= base_url('jurusan/store') ?>" method="post">
        <div class="card p-3 col-lg-6">
            <div class="form-group">
                <label for="nama_jurusan">Nama jurusan</label>
                <input type="text" class="form-control" name="nama_jurusan">
                <div class="text-danger"><?= form_error('nama_jurusan'); ?></div>
            </div>

            <div class="form-group">
                <a href="<?= base_url('jurusan') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>