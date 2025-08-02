<?php
// persiapan funtion untuk upload file/foto
function upload()
{
    // deklarasi variabel kebutuhan
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];


    // cek apakah yang di upload file/gambar
    $eksfilevalid = ['jpg', 'jpeg', 'png', 'pdf'];
    $eksfile = explode('.', $namafile);
    $eksfile = strtolower(end($eksfile));

    if(!in_array($eksfile, $eksfilevalid)){
        echo "<script> alert('Yang anda upload bukan gambar/File PDF..!') </script>";
        return false;
    }
    // cel jka ukuran terlalu besar
    if($ukuranfile > 1000000){
        echo "<script> alert('Ukuran file anda terlalu besar!') </script>";
        return false;
    }
    // jika lolos pengecekan, file sipa upload
    // generate nama file baru

    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $eksfile;

    move_uploaded_file($tmpname, 'file/'.$namafilebaru);
    return $namafilebaru;

}

?>