<?php
    @$halaman = $_GET['halaman'];

    if ($halaman == "departemen") {
        // tampilkan halaman departemen
        // echo "Tampil Halaman Modul Departemen";
        include "modul/departemen/departemen.php";
    } 
    elseif ($halaman == "pengirim_surat") {
        // tampilkan halaman pengirim surat
        include "modul/pengirim_surat/pengirim_surat.php";

    } 
    // elseif ($halaman == "balasan_surat") {
    //     // tampilkan halaman balasan surat
    //     include "user/balasan_surat.php";

    // } 
    elseif ($halaman == "arsip_surat") {
        // tampilkan halaman arsip surat
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] =="hapus"){
            include "modul/arsip_surat/form.php";
        }else
        {
            include "modul/arsip_surat/data.php";
        }
    } 

    else {
        // echo "Tampil Halaman Home";
        include "modul/home.php";
    }
?>
