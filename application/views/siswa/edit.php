<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Siswa</h1>
    </div>

    <?php if ($this->session->flashdata('error')) : ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Error",
                icon: "error",
                text: "<?= $this->session->flashdata('error'); ?>",
                timer: 2000,
            })
        </script>
    <?php
        $this->session->unset_userdata('error');
    endif;
    ?>
    <form action="<?= base_url('siswa/update/' . $siswa->id) ?>" method="post">
        <div class="card p-3 col-sm-9 col-md-7 col-lg-6">

            <div class="form-group">
                <label for="nama_siswa">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_siswa" value="<?= $siswa->nama_siswa ?>">
                <div class="text-danger"><?= form_error('nama_siswa'); ?></div>
            </div>
            <div class="form-group">
                <label for="tgl_lahir_siswa">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir_siswa">
                <small>* isi jika Tanggal Lahir berubah</small>
                <div class="text-danger"><?= form_error('tgl_lahir_siswa'); ?></div>
            </div>
            <div class="form-group">
                <label for="alamat_siswa">Alamat Siswa</label>
                <textarea name="alamat_siswa" class="form-control" cols="10" rows="5"><?= $siswa->alamat_siswa ?></textarea>
                <div class="text-danger"><?= form_error('alamat_siswa'); ?></div>
            </div>

            <div class="form-group">
                <a href="<?= base_url('siswa') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>