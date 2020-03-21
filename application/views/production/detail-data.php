<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Anggaran Administrasi</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php $bulan = $this->db->query("SELECT * FROM tbl_bulan ORDER BY id_bulan ASC")->result();
                    foreach ($bulan as $b) {


                    ?>
                        <div class="form-group">
                            <label>
                                Bulan <?php echo $b->nama_bulan ?>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detail-anggaran">
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
                                        <?php $data = $this->db->query("SELECT * FROM 
                                        tbl_anggaran INNER JOIN
                                        tbl_detail_anggaran 
                                        ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran 
                                        WHERE id_bulan='$b->id_bulan'");
                                        if ($data->num_rows() > 0) {
                                            foreach ($data->result() as $key => $value) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $key + 1 ?></td>
                                                    <td>
                                                        <input type="text" value="<?php echo $value->uraian ?>" name="uraian[]" class="form-control-plaintext" readonly />
                                                    </td>
                                                    <td>
                                                        <input type="number" value="<?php echo $value->volume ?>" name="volume[]" class="form-control-plaintext" readonly />
                                                    </td>
                                                    <td>
                                                        <select class="form-control-plaintext" name="satuan[]" readonly>
                                                            <option value="paket">Paket</option>
                                                            <option value="personel">Personel</option>
                                                            <option value="buku">Buku</option>
                                                            <option value="bulan">Bulan</option>
                                                            <option value="tahun">Tahun</option>
                                                    </td>
                                                    <td>
                                                        <input type="number" value="<?php echo $value->harga_satuan ?>" name="harga-satuan[]" class="form-control-plaintext" readonly />
                                                    </td>
                                                    <td>
                                                        <input type="number" value="<?php echo $value->pengeluaran ?>" name="pengeluaran[]" class="form-control-plaintext" readonly />
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6">
                                                    <h3>Belum Ada Data</h3>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>