


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Data Arsip Surat
  </div>
  <div class="card-body">
    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>No Surat</th>
            <th>Tanggal Surat</th>
            <th>Tanggal Diterima</th>
            <th>Perihal</th>
            <th>Departemen / Tujuan</th>
            <th>Pengirim</th>
            <th>FIle</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Deklarasi variabel nomor urut
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
        while ($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= ($data['non_surat']) ?></td>
            <td><?= ($data['tanggal_surat']) ?></td>
            <td><?= ($data['tanggal_surat']) ?></td>
            <td><?= ($data['prihal']) ?></td>
            <td><?= ($data['nama_departemen']) ?></td>
            <td><?= ($data['nama_pengirim']) ?> / <?=$data['no_hp']?></td>
            <td>
              <?php
                  //uji apakah filenya ada atau tidak
                  if(empty($data['file'])){
                    echo "-";
                  }else{
                    ?>
                    <a href="file/<?=$data['file']?>" target="$_blank"> lihat file </a>
                 <?php   
                  }
              ?>
            </td>
            <td>
                <!-- Tambahkan tombol aksi jika diperlukan -->
                <a href="?halaman=arsip_surat&hal=edit&id=<?= $data['id_arsip'] ?>" class="btn btn-success btn-sm  ">Edit</a>
                <a href="?halaman=arsip_surat&hal=hapus&id=<?= $data['id_arsip'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yankin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
  </div>
</div>
