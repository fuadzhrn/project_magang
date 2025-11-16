


<section class="pt-4">
    <div class="mb-4">
        <h2 class="mb-3">
            <i class="fas fa-envelope"></i> Data Surat
        </h2>
        <p class="text-muted">Kelola semua arsip surat masuk dalam satu tempat</p>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Daftar Arsip Surat
                    </h5>
                </div>
                <div class="col text-right">
                    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data Surat
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%"><i class="fas fa-hashtag"></i></th>
                            <th><i class="fas fa-file"></i> No Surat</th>
                            <th><i class="fas fa-calendar"></i> Tanggal Surat</th>
                            <th><i class="fas fa-calendar-check"></i> Tanggal Diterima</th>
                            <th><i class="fas fa-align-left"></i> Perihal</th>
                            <th><i class="fas fa-building"></i> Departemen</th>
                            <th><i class="fas fa-user"></i> Pengirim</th>
                            <th width="12%"><i class="fas fa-paperclip"></i> File</th>
                            <th width="15%"><i class="fas fa-cogs"></i> Aksi</th>
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
                            <td class="text-center">
                                <span class="badge badge-primary"><?= $no++ ?></span>
                            </td>
                            <td>
                                <strong><?= ($data['non_surat']) ?></strong>
                            </td>
                            <td><?= date('d/m/Y', strtotime($data['tanggal_surat'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($data['tanggal_surat'])) ?></td>
                            <td>
                                <small><?= substr($data['prihal'], 0, 40) . (strlen($data['prihal']) > 40 ? '...' : '') ?></small>
                            </td>
                            <td>
                                <span class="badge badge-info"><?= ($data['nama_departemen']) ?></span>
                            </td>
                            <td>
                                <div>
                                    <strong><?= ($data['nama_pengirim']) ?></strong>
                                    <br>
                                    <small class="text-muted"><i class="fas fa-phone"></i> <?=$data['no_hp']?></small>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php
                                    if(empty($data['file'])){
                                        echo '<span class="badge badge-secondary">Tidak ada file</span>';
                                    } else {
                                        ?>
                                        <a href="file/<?=$data['file']?>" target="_blank" class="btn btn-sm btn-primary" title="Lihat file">
                                            <i class="fas fa-file"></i> Lihat File
                                        </a>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="?halaman=arsip_surat&hal=edit&id=<?= $data['id_arsip'] ?>" class="btn btn-primary btn-sm" title="Edit data">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?halaman=arsip_surat&hal=hapus&id=<?= $data['id_arsip'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus data">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; 
                        
                        if (!$hasData) {
                            echo '<tr><td colspan="9" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Tidak ada data surat</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>