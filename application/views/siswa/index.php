<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>
        <div class="btn-group">
            <a href="<?= base_url('siswa/import') ?>" class="mr-1 btn btn-sm btn-success shadow-sm"><i class="fas fa-upload"></i> Import Excel</a>
            <a href="<?= base_url('siswa/download') ?>" class="mr-1 btn btn-sm btn-danger shadow-sm"><i class="fas fa-download"></i> Download Pdf</a>
            <a href="<?= base_url('siswa/create') ?>" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Create new</a>
        </div>
    </div>

    <!-- SWEETALERT2 -->
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Done',
                text: "<?= $this->session->flashdata('success') ?>",
                timer: 2000
            })
        <?php
        elseif ($this->session->flashdata('update')) :
        ?>
            Swal.fire({
                icon: 'success',
                title: 'Done',
                text: "<?= $this->session->flashdata('update') ?>",
                timer: 2000
            })
        <?php
        endif;
        $this->session->unset_userdata(array('success', 'update'));
        ?>
    </script>
    <!-- END SWEETALERT2 -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas Siswa</th>
                            <th>Wali kelas</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswa->result() as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->nama_siswa; ?></td>
                                <td><?= $row->nama_kelas; ?></td>
                                <td><?= $row->nama_guru; ?></td>
                                <td>
                                    <a href="<?= base_url('siswa/edit/' . $row->id) ?>" class="btn btn-warning mr-1"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger" onclick="remove('<?= $row->id ?>')"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    function remove(id) {
        Swal.fire({
            icon: 'warning',
            title: "Anda yakin?",
            text: "Data akan dihapus permanen!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: "Gak jadi ah"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('siswa/delete/') ?>" + id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: "Harap Tunggu...",
                            text: "Proses...",
                            didOpen: function() {
                                showConfirmButton: false,
                                Swal.showLoading();
                            }
                        })
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: "success",
                            title: "Done",
                            text: data.message,
                        }).then(function(isTrue) {
                            if (isTrue.value) {
                                location.reload();
                            }
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.hideLoading();
                        Swal.fire("!Opps ", "Ada masalah, coba lagi nanti!", "error");
                    }
                })
            }
        })
    }
</script>