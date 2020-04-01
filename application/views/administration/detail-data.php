<div class="container p-4">
    <div class="mb-4 text-right">
        <a href="javascript:void(0)" id="printPageButton" onclick='return printDiv("printableArea")' class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Cetak Laporan
        </a>
    </div>
    <div class="printableArea">
        <h1 class="h3 mb-0 text-gray-800 mb-3">Data Anggaran<br>
            <small>
                Bulan <?php echo $this->anggaran->getBulanById($_GET['select-bulan'])->row()->nama_bulan ?>
                <?php echo $_GET['tahun'] ?>
            </small>
        </h1>
        <div class="row">
            <?php
            $pos = $this->anggaran->getPos($_GET['select-kategori'])->result();
            foreach ($pos as $p) {
                $data = $this->db->query("SELECT * FROM tbl_anggaran "
                    . "INNER JOIN tbl_detail_anggaran "
                    . "ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran "
                    . "INNER JOIN tbl_pos "
                    . "ON tbl_detail_anggaran.id_pos=tbl_pos.id_pos "
                    . "INNER JOIN tbl_kategori "
                    . "ON tbl_pos.id_kategori=tbl_kategori.id_kategori "
                    . "WHERE tbl_anggaran.tahun='" . $_GET['tahun'] . "' "
                    . "AND tbl_anggaran.id_klien='" . $_GET['id-klien'] . "' "
                    . "AND tbl_pos.id_kategori='" . $_GET['select-kategori'] . "' "
                    . "AND tbl_pos.id_pos='$p->id_pos' "
                    . "AND id_bulan='" . $_GET['select-bulan'] . "'");
                if ($data->num_rows() > 0) {
            ?>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label><?php echo $p->nama_pos ?></label>
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
                                                <?php foreach ($data->result() as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $key + 1 ?></td>
                                                        <td>
                                                            <input type="text" value="<?php echo $value->uraian ?>" name="uraian[]" class="form-control-plaintext" readonly />
                                                        </td>
                                                        <td>
                                                            <input type="number" name="volume[]" value="<?php echo $value->volume ?>" class="form-control-plaintext" readonly />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="satuan[]" value="<?php echo $value->satuan ?>" class="form-control-plaintext text-capitalize" readonly />
                                                        </td>
                                                        <td>
                                                            <input type="number" name="harga-satuan[]" value="<?php echo $this->etc->rps($value->harga_satuan) ?>" class="form-control-plaintext" readonly />
                                                        </td>
                                                        <td>
                                                            <input type="number" name="pengeluaran[]" value="<?php echo $this->etc->rps($value->harga_satuan * $value->volume) ?>" class="form-control-plaintext" readonly />
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>