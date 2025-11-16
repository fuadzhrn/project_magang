<section class="pt-4">
    <h2 class="mb-4">Dashboard</h2>

    <?php
    // Hitung total surat masuk
    $total_masuk = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_arsip");
    $data_masuk = mysqli_fetch_array($total_masuk);
    $jumlah_masuk = $data_masuk['total'];

    // Hitung total surat keluar (diasumsikan dari status atau field tertentu)
    $total_keluar = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_arsip WHERE id_arsip > 0");
    $data_keluar = mysqli_fetch_array($total_keluar);
    $jumlah_keluar = $data_keluar['total'];

    // Hitung total pengguna terdaftar
    $total_user = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_user");
    $data_user = mysqli_fetch_array($total_user);
    $jumlah_user = $data_user['total'];
    ?>

    <!-- Stat Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm" style="border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="color: #999; margin: 0; font-size: 0.9rem; font-weight: 500;">Total Surat Masuk</p>
                            <h3 style="color: #0056b3; margin: 0; font-size: 2.5rem; font-weight: bold;"><?php echo $jumlah_masuk; ?></h3>
                        </div>
                        <div style="font-size: 3rem; color: #0056b3; opacity: 0.2;">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm" style="border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="color: #999; margin: 0; font-size: 0.9rem; font-weight: 500;">Total Surat Keluar</p>
                            <h3 style="color: #28a745; margin: 0; font-size: 2.5rem; font-weight: bold;"><?php echo $jumlah_keluar; ?></h3>
                        </div>
                        <div style="font-size: 3rem; color: #28a745; opacity: 0.2;">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm" style="border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="color: #999; margin: 0; font-size: 0.9rem; font-weight: 500;">Pengguna Terdaftar</p>
                            <h3 style="color: #ffc107; margin: 0; font-size: 2.5rem; font-weight: bold;"><?php echo $jumlah_user; ?></h3>
                        </div>
                        <div style="font-size: 3rem; color: #ffc107; opacity: 0.2;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Surat Masuk Terbaru -->
    <div class="card shadow-sm" style="border: none; border-radius: 12px;">
        <div class="card-body">
            <h5 class="mb-4" style="font-weight: 600;">Surat Masuk terbaru</h5>
            
            <div class="table-responsive">
                <table class="table table-hover" style="border-collapse: collapse;">
                    <thead style="background-color: #f0f4f8; border-bottom: 2px solid #e0e0e0;">
                        <tr>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #333;">No</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #333;">Nomor Surat</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #333;">Pengirim</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #333;">Tanggal</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #333;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ambil 10 surat terbaru dari database
                        $tampil = mysqli_query($koneksi, "
                            SELECT tbl_arsip.*, tbl_pengiirim_surat.nama_pengirim
                            FROM tbl_arsip
                            LEFT JOIN tbl_pengiirim_surat ON tbl_arsip.id_pengirim = tbl_pengiirim_surat.id_pengirim_surat
                            ORDER BY tbl_arsip.id_arsip DESC
                            LIMIT 10
                        ");
                        
                        $no = 1;
                        $hasData = false;
                        
                        while ($data = mysqli_fetch_array($tampil)) :
                            $hasData = true;
                        ?>
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 12px; text-align: left;"><?php echo $no++; ?></td>
                            <td style="padding: 12px; text-align: left; font-weight: 500;"><?php echo htmlspecialchars($data['non_surat']); ?></td>
                            <td style="padding: 12px; text-align: left;"><?php echo htmlspecialchars($data['nama_pengirim']); ?></td>
                            <td style="padding: 12px; text-align: left;"><?php echo date('d-m-Y', strtotime($data['tanggal_surat'])); ?></td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="?halaman=arsip_surat&hal=edit&id=<?php echo $data['id_arsip']; ?>" 
                                   class="btn btn-sm" style="background-color: #17a2b8; color: white; border: none; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; margin-right: 5px;">
                                    Detail
                                </a>
                                <a href="?halaman=arsip_surat&hal=hapus&id=<?php echo $data['id_arsip']; ?>" 
                                   class="btn btn-sm" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem;"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile;
                        
                        if (!$hasData) {
                            echo '<tr><td colspan="5" style="padding: 20px; text-align: center; color: #999;">Tidak ada data surat</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>