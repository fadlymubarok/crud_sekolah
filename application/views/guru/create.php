<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Guru</h1>
    </div>

    <form action="<?= base_url('guru/store') ?>" method="post">
        <div class="card p-3">
            <div class="d-flex">
                <div class="form-group w-50 mr-1">
                    <label for="nama_depan">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan">
                    <div class="text-danger"><?= form_error('nama_depan'); ?></div>
                </div>

                <div class="form-group w-50">
                    <label for="nama_belakang">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang">
                    <div class="text-danger"><?= form_error('nama_belakang'); ?></div>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-50 mr-1">
                    <label for="tanggal_lahir_guru">Tanggal lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir_guru">
                    <div class="text-danger"><?= form_error('tanggal_lahir_guru'); ?></div>
                </div>
                <div class="form-group w-50">
                    <label for="alamat_guru">Alamat guru</label>
                    <textarea name="alamat_guru" class="form-control" cols="10" rows="3"></textarea>
                    <div class="text-danger"><?= form_error('alamat_guru'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <a href="<?= base_url('guru') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>