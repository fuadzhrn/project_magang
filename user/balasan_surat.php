<section class="pt-4">
    <div class="mb-4">
        <h2 class="mb-3">
            <i class="fas fa-envelope-open-text"></i> Balasan Surat
        </h2>
        <p class="text-muted">Daftar lengkap semua balasan surat yang telah diterima</p>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Data Balasan Surat
                    </h5>
                </div>
                <div class="col text-right">
                    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%"><i class="fas fa-hashtag"></i> No</th>
                            <th><i class="fas fa-file"></i> No Surat</th>
                            <th><i class="fas fa-calendar"></i> Tanggal Surat</th>
                            <th><i class="fas fa-calendar-check"></i> Tanggal Diterima</th>
                            <th><i class="fas fa-align-left"></i> Perihal</th>
                            <th><i class="fas fa-building"></i> Departemen</th>
                            <th><i class="fas fa-user"></i> Pengirim</th>
                            <th width="15%"><i class="fas fa-paperclip"></i> File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ambil data dari database
                        $tampil = mysqli_query($koneksi, "
                                                SELECT
                                                tbl_arsip.*,
                                                tbl_departemen.nama_departemen,
                                                tbl_pengiirim_surat.nama_pengirim, tbl_pengiirim_surat.no_hp
                                                FROM
                                                tbl_arsip, tbl_departemen, tbl_pengiirim_surat
                                                WHERE
                                                tbl_arsip.id_departemen = tbl_departemen.id_departemen
                                                and tbl_arsip.id_pengirim = tbl_pengiirim_surat.id_pengirim_surat
                                                ");
                        $no = 1;
                        $hasData = false;
                        while ($data = mysqli_fetch_array($tampil)) :
                            $hasData = true;
                        ?>
                        <tr>
                            <td class="text-center font-weight-bold">
                                <span class="badge badge-primary"><?= $no++ ?></span>
                            </td>
                            <td>
                                <strong><?= ($data['non_surat']) ?></strong>
                            </td>
                            <td><?= date('d/m/Y', strtotime($data['tanggal_surat'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($data['tanggal_surat'])) ?></td>
                            <td>
                                <small><?= substr($data['prihal'], 0, 50) . (strlen($data['prihal']) > 50 ? '...' : '') ?></small>
                            </td>
                            <td>
                                <span class="badge badge-info"><?= ($data['nama_departemen']) ?></span>
                            </td>
                            <td>
                                <div>
                                    <strong><?= ($data['nama_pengirim']) ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-phone"></i> <?=$data['no_hp']?>
                                    </small>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php
                                    if(empty($data['file'])){
                                        echo '<span class="badge badge-secondary">-</span>';
                                    } else {
                                        ?>
                                        <a href="file/<?=$data['file']?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download"></i> Lihat
                                        </a>
                                    <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php endwhile; 
                        
                        if (!$hasData) {
                            echo '<tr><td colspan="8" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
