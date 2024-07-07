<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == "tambah") {
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];
    $sinopsis = $_POST['sinopsisBuku'];

    // PROCESS MENYIMPAN GAMBAR
    $cover_buku = '';
    if (isset($_FILES['coverBuku']) && $_FILES['coverBuku']['error'] == 0) {
        $upload_dir = '../../../../assets/book/cover/';
        $allowed_types = array('jpg', 'png', 'jpeg');
        $max_size = 2048 * 1024;
        $file_ext = pathinfo($_FILES['coverBuku']['name'], PATHINFO_EXTENSION);
        $file_name = $judul_buku . date('YmdHis') . '.' . $file_ext;
        $file_path = $upload_dir . $file_name;

        if (in_array($file_ext, $allowed_types) && $_FILES['coverBuku']['size'] <= $max_size) {
            if (move_uploaded_file($_FILES['coverBuku']['tmp_name'], $file_path)) {
                $cover_buku = $file_name;
            } else {
                $_SESSION['gagal'] = "File uploaded failed!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['gagal'] = "Invalid file type or size!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    // PROCESS INSERT DATA TO DATABASE
    $sql = "INSERT INTO buku(judul_buku,kategori_buku,penerbit_buku,pengarang,tahun_terbit,isbn,j_buku_baik,j_buku_rusak,cover_buku,sinopsis)
        VALUES('" . $judul_buku . "','" . $kategori_buku . "','" . $penerbit_buku . "','" . $pengarang . "','" . $tahun_terbit . "','" . $isbn . "', '" . $j_buku_baik . "', '" . $j_buku_rusak . "', '" . $cover_buku . "', '" . $sinopsis . "')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $_SESSION['berhasil'] = "Data buku berhasil ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['act'] == "edit") {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];
    $sinopsis = $_POST['sinopsisBuku'];

    // Get current cover image
    $result = mysqli_query($koneksi, "SELECT cover_buku FROM buku WHERE id_buku = $id_buku");
    $row = mysqli_fetch_assoc($result);
    $current_cover_buku = $row['cover_buku'];

    // Initialize $cover_buku
    $cover_buku = $current_cover_buku; // Use the existing cover_buku if a new one is not uploaded

    if (isset($_FILES['coverBuku']) && $_FILES['coverBuku']['error'] == 0) {
        $upload_dir = '../../../../assets/book/cover/';
        $allowed_types = ['jpg', 'png', 'jpeg'];
        $max_size = 2048 * 1024;
        $file_ext = pathinfo($_FILES['coverBuku']['name'], PATHINFO_EXTENSION);
        $file_name = $judul_buku . date('Ymdhis') . '.' . $file_ext;
        $file_path = $upload_dir . $file_name;

        if (in_array($file_ext, $allowed_types) && $_FILES['coverBuku']['size'] <= $max_size) {
            if (move_uploaded_file($_FILES['coverBuku']['tmp_name'], $file_path)) {
                // Remove old file
                if (file_exists($upload_dir . $cover_buku)) {
                    unlink($upload_dir . $cover_buku);
                }
                $cover_buku = $file_name;
                // print_r($cover_buku);
            } else {
                $_SESSION['gagal'] = "File upload failed!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['gagal'] = "Invalid file type or size!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    // PROCESS EDIT DATA
    $query = "UPDATE buku SET judul_buku = '$judul_buku', kategori_buku = '$kategori_buku', penerbit_buku = '$penerbit_buku', 
                pengarang = '$pengarang', tahun_terbit = '$tahun_terbit', isbn = '$isbn', j_buku_baik = '$j_buku_baik', j_buku_rusak = '$j_buku_rusak', cover_buku = '$cover_buku', sinopsis = '$sinopsis'";

    $query .= "WHERE id_buku = $id_buku";

    $sql = mysqli_query($koneksi, $query);
    if ($sql) {
        $_SESSION['berhasil'] = "Data buku berhasil diedit!";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal diedit!";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    // $id_buku = $_POST['id_buku'];
    // $judul_buku = $_POST['judulBuku'];
    // $kategori_buku = $_POST['kategoriBuku'];
    // $penerbit_buku = $_POST['penerbitBuku'];
    // $pengarang = $_POST['pengarang'];
    // $tahun_terbit = $_POST['tahunTerbit'];
    // $isbn = $_POST['iSbn'];
    // $j_buku_baik = $_POST['jumlahBukuBaik'];
    // $j_buku_rusak = $_POST['jumlahBukuRusak'];
    // $sinopsis = $_POST['sinopsisBuku'];

    // $cover_buku = $row['cover_buku']; // Existing cover
    // if (isset($_FILES['coverBuku']) && $_FILES['coverBuku']['error'] == 0) {
    //     $upload_dir = '../../../../assets/book/cover/';
    //     $allowed_types = ['jpg', 'png', 'jpeg'];
    //     $max_size = 2048 * 1024;
    //     $file_ext = pathinfo($_FILES['coverBuku']['name'], PATHINFO_EXTENSION);
    //     $file_name = $judul_buku . date('YmdHis') . '.' . $file_ext;
    //     $file_path = $upload_dir . $file_name;

    //     if (in_array($file_ext, $allowed_types) && $_FILES['coverBuku']['size'] <= $max_size) {
    //         if (move_uploaded_file($_FILES['coverBuku']['tmp_name'], $file_path)) {
    //             if (file_exists($upload_dir . $cover_buku)) {
    //                 unlink($upload_dir . $cover_buku);
    //             }
    //             $cover_buku = $file_name;
    //         } else {
    //             $_SESSION['gagal'] = "File upload failed!";
    //             header("Location: " . $_SERVER['HTTP_REFERER']);
    //             exit;
    //         }
    //     } else {
    //         $_SESSION['gagal'] = "Invalid file type or size!";
    //         header("Location: " . $_SERVER['HTTP_REFERER']);
    //         exit;
    //     }
    // }

    // $query = "UPDATE buku SET judul_buku = '$judul_buku', kategori_buku = '$kategori_buku', penerbit_buku = '$penerbit_buku', 
    //             pengarang = '$pengarang', tahun_terbit = '$tahun_terbit', isbn = '$isbn', j_buku_baik = '$j_buku_baik', 
    //             j_buku_rusak = '$j_buku_rusak', cover_buku = '$cover_buku', sinopsis = '$sinopsis' WHERE id_buku = $id_buku";

    // $sql = mysqli_query($koneksi, $query);
    // if ($sql) {
    //     $_SESSION['berhasil'] = "Data buku berhasil diedit!";
    //     header("Location: " . $_SERVER['HTTP_REFERER']);
    // } else {
    //     $_SESSION['gagal'] = "Data buku gagal diedit!";
    //     header("Location: " . $_SERVER['HTTP_REFERER']);
    // }
} elseif ($_GET['act'] == "hapus") {
    $id_buku = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id_buku'");

    if ($sql) {
        $_SESSION['berhasil'] = "Data buku berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}
