<?php
  // panggil function untuk upload file
  include "config/function.php";
  // uji jika kilck tombol edit/ hapus
  if(isset($_GET['hal']))
  {

    if($_GET['hal'] == "edit")
    {
            // tampilkan data yang akan di edit
            $tampil = mysqli_query($koneksi, "SELECT
                              tbl_arsip.*,
                              tbl_departemen.nama_departemen,
                              tbl_pengiirim_surat.nama_pengirim, tbl_pengiirim_surat.no_hp
                              FROM
                              tbl_arsip, tbl_departemen, tbl_pengiirim_surat
                              WHERE
                              tbl_arsip.id_departemen = tbl_departemen.id_departemen
                              and tbl_arsip.id_pengirim = tbl_pengiirim_surat.id_pengirim_surat and tbl_arsip. id_arsip= '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                // jika data ditemukan maka data di tampung ke dalam variabel
                $vnon_surat = $data['non_surat'];
                $vtanggal_surat = $data['tanggal_surat'];
                $vtanggal_diterima= $data['tanggal_diterima'];
                $vprihal = $data['prihal'];
                $vid_departemen = $data['id_departemen'];
                $vnama_departemen = $data['nama_departemen'];
                $vid_pengirim = $data['id_pengirim'];
                $vnama_pengirim = $data['nama_pengirim'];
                $vfile =$data['file'];

            }
    }
    elseif($_GET['hal'] == 'hapus' )
    {
      $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
      if($hapus){
        echo"<script>
        alert('Hapus Data Sukses');
        document.location='?halaman=arsip_surat'
        </script>";
      }
    }
     
  }

// uji  jika tombol simpan dio klick
if(isset($_POST['bsimpan']))
{

    // pengujian apakah data akan di edit atau simpan baru
    if (@$_GET['hal'] == "edit") {
      // perintah edit data
       // ubah data

      //  cek apakah user pilih file atau gamabar atau tidak
      if($_FILES['file']['error'] === 4){
        $file = $vfile;
      }else{
        $file = upload();
      }

       $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip  SET    
                          non_surat         = '$_POST[non_surat]', 
                          tanggal_surat     = '$_POST[tanggal_surat]', 
                          tanggal_diterima  = '$_POST[tanggal_diterima]', 
                          prihal            = '$_POST[prihal]', 
                          id_departemen     = '$_POST[id_departemen]', 
                          id_pengirim       = '$_POST[id_pengirim]', 
                          file              = '$file'
                        WHERE id_arsip = '$_GET[id]' ");

       if($ubah)
       {
           echo"<script>
               alert('Ubah Data Sukses');
               document.location='?halaman=arsip_surat'
               </script>";
       }else{
        echo"<script>
               alert('Ubah Data GAGAL!!');
               document.location='?halaman=arsip_surat'
               </script>";
       }
    }
    else
    {
      // perintah simpan data baru
      // simpan data
        $file = upload();
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip VALUES ('','$_POST[non_surat]','$_POST[tanggal_surat]','$_POST[tanggal_diterima]','$_POST[prihal]','$_POST[id_departemen]','$_POST[id_pengirim]','$file')");

        if($simpan)
        {
            echo"<script>
                alert('Simpan Data Sukses');
                document.location='?halaman=arsip_surat'
                </script>";
        }else{
          echo"<script>
          alert('Simpan Data GAGAL!!');
          document.location='?halaman=arsip_surat'
          </script>";
        }
    }
    
    
}

    

?>


<div class="card mt-3">
  <div class="card-header" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; font-weight: 600; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 10px;">
    <i class="fas fa-file-alt"></i>
    <?php if(isset($_GET['hal']) && $_GET['hal'] == "edit"): ?>
      Edit Data Arsip Surat
    <?php else: ?>
      Tambah Data Arsip Surat
    <?php endif; ?>
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="non_surat"><i class="fas fa-barcode"></i> No. Surat <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="non_surat" name="non_surat" value="<?=@$vnon_surat?>" required placeholder="Contoh: SRT/001/2025">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="tanggal_surat"><i class="fas fa-calendar"></i> Tanggal Surat <span style="color: red;">*</span></label>
            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?=@$vtanggal_surat?>" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="tanggal_diterima"><i class="fas fa-calendar-check"></i> Tanggal Diterima <span style="color: red;">*</span></label>
            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?=@$vtanggal_diterima?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="prihal"><i class="fas fa-heading"></i> Perihal <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="prihal" name="prihal" value="<?=@$vprihal?>" required placeholder="Isi perihal surat">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="id_departemen"><i class="fas fa-building"></i> Departemen / Tujuan <span style="color: red;">*</span></label>
            <select class="form-control" name="id_departemen" required>
              <option value="<?=@$vid_departemen?>" selected><?=@$vnama_departemen?></option>
              <?php
                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen ORDER BY nama_departemen ASC");
                while($data = mysqli_fetch_array($tampil)){
                  echo "<option value='{$data['id_departemen']}'>{$data['nama_departemen']}</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="id_pengirim"><i class="fas fa-user"></i> Pengirim Surat <span style="color: red;">*</span></label>
            <select class="form-control" name="id_pengirim" required>
              <option value="<?=@$vid_pengirim?>" selected><?=@$vnama_pengirim?></option>
              <?php
                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengiirim_surat ORDER BY nama_pengirim ASC");
                while($data = mysqli_fetch_array($tampil)){
                  echo "<option value='{$data['id_pengirim_surat']}'>{$data['nama_pengirim']}</option>";
                }
              ?>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="file"><i class="fas fa-file-upload"></i> Upload File <span style="color: #999;">(PDF, Word, Excel, dll)</span></label>
        <div id="dropZone" style="position: relative; border: 2px dashed #0056b3; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer; background-color: #f8f9fa; transition: all 0.3s ease;">
          <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
          <div id="uploadContent" style="pointer-events: none;">
            <i class="fas fa-cloud-upload-alt" style="font-size: 2.5rem; color: #0056b3; margin-bottom: 10px; display: block;"></i>
            <p style="margin-bottom: 0; color: #0056b3; font-weight: 600;">Klik atau drag file di sini</p>
            <small style="color: #999;">File maksimal 10MB. Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG</small>
          </div>
          <div id="successContent" style="display: none; pointer-events: none;">
            <i class="fas fa-check-circle" style="font-size: 2.5rem; color: #28a745; margin-bottom: 10px; display: block; animation: scaleIn 0.5s ease-out;"></i>
            <p style="margin-bottom: 0; color: #28a745; font-weight: 600;">File berhasil dipilih!</p>
            <small style="color: #666;" id="selectedFileName">Nama file</small>
          </div>
        </div>
        <div id="uploadStatus" style="display: none; margin-top: 15px; padding: 12px 15px; border-radius: 8px; font-size: 0.95rem;">
          <div id="errorStatus" style="display: none; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
            <i class="fas fa-exclamation-circle"></i> <span id="errorMessage"></span>
          </div>
        </div>
        <?php if(@$vfile): ?>
          <small class="d-block mt-2"><i class="fas fa-check-circle" style="color: green;"></i> File saat ini: <strong><?=@$vfile?></strong></small>
        <?php endif; ?>
      </div>

      <style>
        @keyframes scaleIn {
          0% { 
            transform: scale(0);
            opacity: 0;
          }
          50% {
            transform: scale(1.1);
          }
          100% { 
            transform: scale(1);
            opacity: 1;
          }
        }
      </style>

      <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('file');
        const uploadContent = document.getElementById('uploadContent');
        const successContent = document.getElementById('successContent');
        const uploadStatus = document.getElementById('uploadStatus');
        const errorStatus = document.getElementById('errorStatus');
        const errorMessage = document.getElementById('errorMessage');
        const selectedFileName = document.getElementById('selectedFileName');

        // Handle file input change
        fileInput.addEventListener('change', function(e) {
          if(this.files.length > 0) {
            const file = this.files[0];
            
            // Validasi file size (10MB)
            if(file.size > 10485760) {
              showError('File terlalu besar! Maksimal 10MB');
              fileInput.value = '';
              return;
            }
            
            // Validasi format file
            const validFormats = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if(!validFormats.includes(fileExtension)) {
              showError('Format file tidak didukung!');
              fileInput.value = '';
              return;
            }
            
            showSuccess(file.name);
          }
        });

        // Highlight drop zone when dragging over it
        dropZone.addEventListener('dragover', function(e) {
          e.preventDefault();
          dropZone.style.backgroundColor = '#e3f2fd';
          dropZone.style.borderColor = '#0056b3';
        });

        dropZone.addEventListener('dragleave', function(e) {
          e.preventDefault();
          dropZone.style.backgroundColor = '#f8f9fa';
          dropZone.style.borderColor = '#0056b3';
        });

        dropZone.addEventListener('drop', function(e) {
          e.preventDefault();
          dropZone.style.backgroundColor = '#f8f9fa';
          const files = e.dataTransfer.files;
          if(files.length > 0) {
            fileInput.files = files;
            // Trigger change event
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
          }
        });

        function showSuccess(name) {
          uploadContent.style.display = 'none';
          successContent.style.display = 'block';
          selectedFileName.textContent = name;
          errorStatus.style.display = 'none';
          dropZone.style.borderColor = '#28a745';
          dropZone.style.backgroundColor = '#f1f8f4';
        }

        function showError(message) {
          uploadContent.style.display = 'block';
          successContent.style.display = 'none';
          errorStatus.style.display = 'block';
          errorMessage.textContent = message;
          dropZone.style.borderColor = '#0056b3';
          dropZone.style.backgroundColor = '#f8f9fa';
        }

        // Reset status when form resets
        document.querySelector('form').addEventListener('reset', function(e) {
          uploadContent.style.display = 'block';
          successContent.style.display = 'none';
          errorStatus.style.display = 'none';
          dropZone.style.borderColor = '#0056b3';
          dropZone.style.backgroundColor = '#f8f9fa';
        });
      </script>

      <div style="display: flex; gap: 10px; margin-top: 2rem;">
        <button type="submit" name="bsimpan" class="btn btn-primary" style="flex: 1; padding: 0.75rem; font-weight: 600;">
          <i class="fas fa-save"></i> <?php if(isset($_GET['hal']) && $_GET['hal'] == "edit"): ?>Simpan Perubahan<?php else: ?>Tambah Data<?php endif; ?>
        </button>
        <button type="reset" name="bbatal" class="btn btn-secondary" style="flex: 1; padding: 0.75rem; font-weight: 600;">
          <i class="fas fa-redo"></i> Reset
        </button>
        <a href="?halaman=arsip_surat" class="btn btn-outline-secondary" style="flex: 1; padding: 0.75rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center;">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</div>