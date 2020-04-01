<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Master</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Anggaran Peralatan/Garansi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?php echo site_url('dashboard/administration') ?>" method="POST">
                        <div class="form-group">
                            <div style="float:right">
                                <a href="<?php echo site_url('dashboard/tambah_admin') ?>" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <di class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
                                </div>
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th width="15%">Nama Perusahaan</th>
                                        <th width="15%">Nama Klien</th>
                                        <th width="15%">Tahun</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($anggaran as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo $value->nama_perusahaan ?></td>
                                            <td><?php echo $value->nama_klien ?></td>
                                            <td><?php echo $value->tahun ?></td>
                                            <td>
                                                <!-- <a href="<?php echo site_url('dashboard/edit_admin/' . $value->id_anggaran) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a> -->

                                                <a href="javacript:void(0)" class="btn btn-success" onclick="return showModal('<?php echo $value->id_klien ?>','<?php echo $value->tahun ?>')"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo site_url('dashboard/delete_admin/' . $value->id_anggaran) ?>" onclick="return confirm('Hapus data ini?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    <?php   }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('dashboard/detail_data_admin') ?>" method="GET" target="_blank">
                <div class="card mx-4 mt-4">
                    <div class="card-header">
                        <h4 class='lead font-weight-bold'>Lihat Detail Perbulan</h4>
                    </div>
                    <div class=" card-body modal-body">
                        <input type="hidden" name='tahun' />
                        <input type="hidden" name='id-klien' />
                        <input type="hidden" name='select-kategori' value='1' />
                        <div class="form-group">
                            <label>Pilih Bulan</label>
                            <select class="form-control" name="select-bulan" required>
                                <option value=''>--Silahkan Pilih--</option>
                                <?php foreach ($bulan as $b) { ?>
                                    <option value="<?php echo $b->id_bulan ?>"><?php echo $b->nama_bulan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Show Detail</button>
                    </div>
                </div>
            </form>
            <form action="<?php echo site_url('dashboard/edit_pos') ?>" method="GET" target="_blank">
                <div class="card mx-4 mb-4">
                    <div class="card-header">
                        <h4 class='lead font-weight-bold'>Edit Detail Perbulan</h4>
                    </div>
                    <div class=" card-body modal-body">
                        <input type="hidden" name='tahun' />
                        <input type="hidden" name='id-klien' />
                        <input type="hidden" name='select-kategori' value='1' />
                        <div class="form-group">
                            <label>Pilih Bulan untuk diedit</label>
                            <select class="form-control" name="select-bulan" required>
                                <option value=''>--Silahkan Pilih--</option>
                                <?php foreach ($bulan as $b) { ?>
                                    <option value="<?php echo $b->id_bulan ?>"><?php echo $b->nama_bulan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Pos</label>
                            <select class="form-control" name="select-pos" required>
                                <option value=''>--Silahkan Pilih--</option>
                                <?php foreach ($pos as $value) { ?>
                                    <option value="<?php echo $value->id_pos ?>"><?php echo $value->nama_pos ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Show Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-bulan" tabindex="-1" role="dialog" aria-labelledby="edit-bulan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function showModal(idKlien, tahun) {
        $('[name="tahun"]').val(tahun);
        $('[name="id-klien"]').val(idKlien);
        $('#detail-modal').modal('toggle');
    }
</script>