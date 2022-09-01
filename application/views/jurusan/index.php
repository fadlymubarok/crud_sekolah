<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jurusan</h1>
        <a href="<?= base_url('jurusan/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Create new</a>
    </div>

    <!-- sweetalert setelah create/update/delete -->
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) : ?>
            Swal.fire({
                title: 'Done',
                icon: 'success',
                text: '<?= $this->session->flashdata('success') ?>'
            });
        <?php
            // unset($_SESSION['success']);
            $this->session->unset_userdata('success');
        endif; ?>
        <?php if ($this->session->flashdata('update')) : ?>
            Swal.fire({
                title: 'Done',
                icon: 'success',
                text: '<?= $this->session->flashdata('update') ?>'
            });
        <?php $this->session->unset_userdata('update');
        endif; ?>
    </script>

    <!-- end -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th width='150px'>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jurusan->result() as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->nama_jurusan; ?></td>
                                <td>
                                    <a href="<?= base_url('jurusan/edit/' . $row->id) ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger" onclick="remove('<?= $row->id ?>')"><i class="fas fa-trash"></i></button>
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
            title: 'Anda yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: "Gak jadi ah"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('jurusan/delete/') ?>" + id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: "Harap tunggu...",
                            text: "Loading!",
                            didOpen: function() {
                                showConfirmButton: false,
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Berhasil",
                            icon: "success",
                            text: data.message,
                            showCancelButton: false,
                            timer: 3000,
                        }).then(function(isTrue) {
                            if (isTrue.value) {
                                location.reload();
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.hideLoading();
                        Swal.fire("!Opps ", "Something went wrong, try again later", "error");
                    }
                })
            }
        })
    }
</script>