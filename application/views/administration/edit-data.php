<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggaran</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
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
                    <form action="<?php echo site_url('dashboard/update_admin') ?>" method="POST">
                        <div class="form-group">
                            <h5><?php echo $this->pos->getById($_GET['select-pos'])->nama_pos ?></h5>
                        </div>

                        <div class="form-group">
                            <label>Klien</label>
                            <h5><?php echo $anggaran->nama_perusahaan ?></h5>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <h5><?php echo $_GET['tahun'] ?></h5>
                        </div>

                        <div class="form-group">
                            <label>
                                Bulan
                            </label>
                            <h5><?php echo $this->anggaran->getBulanById($_GET['select-bulan'])->row()->nama_bulan ?></h5>
                        </div>

                        <div class="form-group">
                            <h7>
                                Detail Anggaran
                            </h7>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Uraian</th>
                                            <th>Volume</th>
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Pengeluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $detail = $this->anggaran->getDetailByBulan(
                                            $_GET['id-anggaran'],
                                            $_GET['tahun'],
                                            $_GET['select-pos'],
                                            $_GET['select-bulan']
                                        );
                                        foreach ($detail as $key => $d) {
                                        ?>
                                            <tr>
                                                <td><?php echo $key + 1 ?></td>
                                                <td>
                                                    <input type="hidden" name="id_detail[]" value="<?php echo $d->id_detail_anggaran ?>">
                                                    <input type="text" name="uraian[]" class="form-control" value="<?php echo $d->uraian ?>" />
                                                </td>
                                                <td>
                                                    <input type="number" name="volume[]" class="form-control" value="<?php echo $d->volume ?>" />
                                                </td>
                                                <td>
                                                    <select class="form-control" name="satuan[]">
                                                        <option value="paket" <?php echo $d->satuan == "paket" ? "selected" : "" ?>>Paket</option>
                                                        <option value="personel" <?php echo $d->satuan == "personel" ? "selected" : "" ?>>Personel</option>
                                                        <option value="buku" <?php echo $d->satuan == "buku" ? "selected" : "" ?>>Buku</option>
                                                        <option value="bulan" <?php echo $d->satuan == "bulan" ? "selected" : "" ?>>Bulan</option>
                                                        <option value="tahun" <?php echo $d->satuan == "tahun" ? "selected" : "" ?>>Tahun</option>
                                                </td>
                                                <td>
                                                    <input type="number" name="harga-satuan[]" class="form-control" value="<?php echo $d->harga_satuan ?>" />
                                                </td>
                                                <td>
                                                    <input type="number" name="pengeluaran[]" readonly class="form-control" value="<?php echo $d->harga_satuan * $d->volume ?>" />
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">
                                                <a class="btn btn-primary" href="#">Tambah Inputan</a>
                                            </td>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                        </div>
                        <div class="from-group text-right">
                            <input type="submit" class="btn btn-success" value="Simpan" />
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