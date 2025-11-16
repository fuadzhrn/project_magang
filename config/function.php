<?php
// persiapan funtion untuk upload file/foto
function upload()
{
    // deklarasi variabel kebutuhan
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    // cek apakah file ada error
    if($error !== 0){
        echo "<script> alert('Error: File gagal diunggah! Kode error: " . $error . "') </script>";
        return false;
    }

    // cek apakah yang di upload file/dokumen yang valid
    $eksfilevalid = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
    $eksfile = explode('.', $namafile);
    $eksfile = strtolower(end($eksfile));

    if(!in_array($eksfile, $eksfilevalid)){
        echo "<script> alert('Format file tidak didukung! Gunakan: JPG, PNG, PDF, DOC, DOCX, XLS, atau XLSX') </script>";
        return false;
    }
    
    // cek jika ukuran terlalu besar (10MB)
    if($ukuranfile > 10485760){
        echo "<script> alert('Ukuran file terlalu besar! Maksimal 10MB') </script>";
        return false;
    }

    // cek dan buat folder file jika belum ada
    $uploaddir = 'file/';
    if(!is_dir($uploaddir)){
        mkdir($uploaddir, 0777, true);
    }

    // jika lolos pengecekan, file siap upload
    // generate nama file baru dengan timestamp
    $namafilebaru = uniqid() . '_' . time();
    $namafilebaru .= '.';
    $namafilebaru .= $eksfile;

    $filepath = $uploaddir . $namafilebaru;

    if(move_uploaded_file($tmpname, $filepath)){
        return $namafilebaru;
    } else {
        echo "<script> alert('Gagal mengupload file! Pastikan folder file/ memiliki izin write') </script>";
        return false;
    }
}

?>