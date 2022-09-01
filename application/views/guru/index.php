<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Guru</h1>
        <a href="<?= base_url('guru/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Create new</a>
    </div>

    <!-- FLASHDATA  -->
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) : ?>
            Swal.fire({
                title: "Done",
                icon: "success",
                text: "<?= $this->session->flashdata('success'); ?>"
            });
        <?php elseif ($this->session->flashdata('update')) : ?>
            Swal.fire({
                title: "Done",
                icon: "success",
                text: "<?= $this->session->flashdata('update'); ?>"
            });
        <?php elseif ($this->session->flashdata('error')) : ?>
            Swal.fire({
                title: "Error",
                icon: "error",
                text: "<?= $this->session->flashdata('error'); ?>"
            });
        <?php
        endif;
        $this->session->unset_userdata(array('success', 'update', 'error'));
        ?>
    </script>

    <!-- END FLASHDATA -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Umur Guru</th>
                            <th>Alamat Guru</th>
                            <th>Status Guru</th>
                            <th width="120px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($guru->result() as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->nama_guru; ?></td>
                                <td>
                                    <?php
                                    $my_year = substr($row->tanggal_lahir_guru, 0, 4);
                                    $now_year = Date('Y');
                                    $result = $now_year - $my_year;
                                    ?>
                                    <?= $result; ?> Tahun
                                </td>
                                <td><?= $row->alamat_guru; ?></td>
                                <td>
                                    <?php
                                    $status = '';
                                    if ($row->status_aktif == 1) {
                                        $status = '<div class="badge badge-info px-3 py-2">Aktif</div>';
                                    } else {
                                        $status = '<div class="badge badge-danger px-3 py-2">Keluar</div>';
                                    }
                                    ?>
                                    <?= $status; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('guru/edit/' . $row->id) ?>" class="btn btn-warning mr-1"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger" onclick="remove('<?= $row->id; ?>')"><i class="fas fa-trash"></i></button>
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
            icon: "warning",
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
                    url: "<?= base_url('guru/delete/') ?>" + id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: "Harap tunggu...",
                            text: "Proses...",
                            didOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: "success",
                            title: "Done",
                            text: data.message
                        }).then(function(isTrue) {
                            if (isTrue.value) {
                                location.reload();
                            }
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.hideLoading();
                        swal.fire("!Opps ", "Something went wrong, try again later", "error");
                    }
                })
            }
        })
    }
</script>