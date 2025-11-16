<?php
// uji  jika tombol simpan dio klick
if(isset($_POST['bsimpan']))
{

    // pengujian apakah data akan di edit atau simpan baru
    if (@$_GET['hal'] == "edit") {
      // perintah edit data
       // ubah data
       $ubah = mysqli_query($koneksi, "UPDATE tbl_pengiirim_surat  SET    
                          nama_pengirim = '$_POST[nama_pengirim]', 
                          alamat = '$_POST[alamat]', 
                          no_hp = '$_POST[no_hp]', 
                          email = '$_POST[email]' 
                          where id_pengirim_surat = '$_GET[id]' ");

       if($ubah)
       {
           echo"<script>
               alert('Ubah Data Sukses');
               document.location='?halaman=pengirim_surat'
               </script>";
       }else{
        echo"<script>
               alert('Ubah Data GAGAL!!');
               document.location='?halaman=pengirim_surat'
               </script>";
       }
    }
    else
    {
      // perintah simpan data baru
      // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_pengiirim_surat VALUES ('','$_POST[nama_pengirim]','$_POST[alamat]','$_POST[no_hp]','$_POST[email]')");

        if($simpan)
        {
            echo"<script>
                alert('Simpan Data Sukses');
                document.location='?halaman=pengirim_surat'
                </script>";
        }else{
          echo"<script>
          alert('Simpan Data GAGAL!!');
          document.location='?halaman=pengirim_surat'
          </script>";
        }
    }
    
    
}

    // uji jika kilck tombol edit/ hapus
    if(isset($_GET['hal']))
    {

      if($_GET['hal'] == "edit")
      {
              // tampilkan data yang akan di edit
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengiirim_surat where id_pengirim_surat= '$_GET[id]'");
              $data = mysqli_fetch_array($tampil);
              if($data)
              {
                  // jika data ditemukan maka data di tampung ke dalam variabel
                  $vnama_pengirim = $data['nama_pengirim'];
                  $valamat = $data['alamat'];
                  $vno_hp = $data['no_hp'];
                  $vemail = $data['email'];
              }
      }else{
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengiirim_surat WHERE id_pengirim_surat='$_GET[id]'");
        if($hapus){
          echo"<script>
          alert('Hapus Data Sukses');
          document.location='?halaman=pengirim_surat'
          </script>";
        }
      }
       
    }

?>

<section class="pt-4">
    <div class="mb-4">
        <h2 class="mb-3">
            <i class="fas fa-user-tie"></i> Manajemen Data Pengirim Surat
        </h2>
        <p class="text-muted">Kelola semua data pengirim surat yang masuk ke organisasi</p>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; font-weight: 600; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-plus-circle"></i> <?php echo (isset($_GET['hal']) && $_GET['hal'] == "edit") ? 'Edit' : 'Tambah'; ?> Pengirim Surat
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pengirim">
                                        <i class="fas fa-user"></i> Nama Pengirim <span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" 
                                           placeholder="Masukkan nama pengirim lengkap" value="<?=@$vnama_pengirim?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">
                                        <i class="fas fa-phone"></i> Nomor HP / Telepon <span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" 
                                           placeholder="Contoh: 0812-3456-7890" value="<?=@$vno_hp?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-map-marker-alt"></i> Alamat <span style="color: red;">*</span>
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                                      placeholder="Masukkan alamat lengkap pengirim surat" required><?=@$valamat?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email <span style="color: red;">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="Masukkan email pengirim" value="<?=@$vemail?>" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" name="bsimpan" class="btn btn-primary" style="min-width: 150px;">
                                <i class="fas fa-save"></i> <?php echo (isset($_GET['hal']) && $_GET['hal'] == "edit") ? 'Perbarui' : 'Simpan'; ?>
                            </button>
                            <a href="?halaman=pengirim_surat" class="btn btn-secondary" style="min-width: 150px;">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; font-weight: 600; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-list"></i> Daftar Pengirim Surat
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="8%"><i class="fas fa-hashtag"></i></th>
                                    <th><i class="fas fa-user"></i> Nama Pengirim</th>
                                    <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                    <th><i class="fas fa-phone"></i> No. HP</th>
                                    <th><i class="fas fa-envelope"></i> Email</th>
                                    <th width="15%"><i class="fas fa-cogs"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengiirim_surat ORDER BY id_pengirim_surat DESC");
                                $hasData = false;
                                while ($data = mysqli_fetch_array($tampil)) :
                                    $hasData = true;
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($data['nama_pengirim']) ?></strong>
                                    </td>
                                    <td>
                                        <small><?= htmlspecialchars(substr($data['alamat'], 0, 40)) . (strlen($data['alamat']) > 40 ? '...' : '') ?></small>
                                    </td>
                                    <td>
                                        <small><?= htmlspecialchars($data['no_hp']) ?></small>
                                    </td>
                                    <td>
                                        <small><?= htmlspecialchars($data['email']) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <a href="?halaman=pengirim_surat&hal=edit&id=<?= $data['id_pengirim_surat'] ?>" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="?halaman=pengirim_surat&hal=hapus&id=<?= $data['id_pengirim_surat'] ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                                           title="Hapus">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                
                                if (!$hasData) {
                                    echo '<tr><td colspan="6" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Tidak ada data pengirim surat</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
