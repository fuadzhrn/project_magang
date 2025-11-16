<?php
// uji  jika tombol simpan dio klick
if(isset($_POST['bsimpan']))
{

    // pengujian apakah data akan di edit atau simpan baru
    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
      // perintah edit data
       // ubah data
       $ubah = mysqli_query($koneksi, "UPDATE tbl_departemen SET nama_departemen = '$_POST[nama_departemen]' where id_departemen = '$_GET[id]' ");

       if($ubah)
       {
           echo"<script>
               alert('Ubah Data Sukses');
               document.location='?halaman=departemen'
               </script>";
       }
    }
    else
    {
      // perintah simpan data baru
      // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_departemen VALUES ('','$_POST[nama_departemen]')");

        if($simpan)
        {
            echo"<script>
                alert('Simpan Data Sukses');
                document.location='?halaman=departemen'
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
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen where id_departemen= '$_GET[id]'");
              $data = mysqli_fetch_array($tampil);
              if($data)
              {
                  // jika data ditemukan maka data di tampung ke dalam variabel
                  $vnama_departemen = $data['nama_departemen'];
              }
      }else{
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_departemen WHERE id_departemen='$_GET[id]'");
        if($hapus){
          echo"<script>
          alert('Hapus Data Sukses');
          document.location='?halaman=departemen'
          </script>";
        }
      }
       
    }

?>

<section class="pt-4">
    <div class="mb-4">
        <h2 class="mb-3">
            <i class="fas fa-building"></i> Manajemen Data Departemen
        </h2>
        <p class="text-muted">Kelola semua data departemen organisasi Anda</p>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; font-weight: 600; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-plus-circle"></i> <?php echo (isset($_GET['hal']) && $_GET['hal'] == "edit") ? 'Edit' : 'Tambah'; ?> Departemen
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="nama_departemen">
                                <i class="fas fa-tag"></i> Nama Departemen <span style="color: red;">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" 
                                   placeholder="Masukkan nama departemen (contoh: Bagian Keuangan, Bagian Operasional, dll)" 
                                   value="<?=@$vnama_departemen?>" required>
                            <small class="form-text text-muted">Isikan nama departemen dengan jelas agar mudah diidentifikasi</small>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" name="bsimpan" class="btn btn-primary" style="min-width: 150px;">
                                <i class="fas fa-save"></i> <?php echo (isset($_GET['hal']) && $_GET['hal'] == "edit") ? 'Perbarui' : 'Simpan'; ?>
                            </button>
                            <a href="?halaman=departemen" class="btn btn-secondary" style="min-width: 150px;">
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
                    <i class="fas fa-list"></i> Daftar Departemen
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="8%"><i class="fas fa-hashtag"></i></th>
                                    <th><i class="fas fa-folder"></i> Nama Departemen</th>
                                    <th width="15%"><i class="fas fa-cogs"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen ORDER BY id_departemen DESC");
                                $hasData = false;
                                while ($data = mysqli_fetch_array($tampil)) :
                                    $hasData = true;
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($data['nama_departemen']) ?></strong>
                                    </td>
                                    <td class="text-center">
                                        <a href="?halaman=departemen&hal=edit&id=<?= $data['id_departemen'] ?>" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="?halaman=departemen&hal=hapus&id=<?= $data['id_departemen'] ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                                           title="Hapus">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                
                                if (!$hasData) {
                                    echo '<tr><td colspan="3" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Tidak ada data departemen</td></tr>';
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
