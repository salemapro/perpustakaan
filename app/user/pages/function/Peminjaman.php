<?php
session_start();
//------------------------------::::::::::::::::::::------------------------------\\
// Dibuat oleh FA Team di PT. Pacifica Raya Technology \\
//------------------------------::::::::::::::::::::------------------------------\\
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "pinjam") {

    if ($_POST['judulBuku'] == NULL) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih buku yang akan dipinjam !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } elseif ($_POST['kondisiBukuSaatDipinjam'] == NULL) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih kondisi buku yang akan dipinjam !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {

        include "Pemberitahuan.php";

        $nama_anggota = $_POST['namaAnggota'];
        $judul_buku = $_POST['judulBuku'];
        $tgl_peminjaman_not_formated = $_POST['tanggalPeminjaman'];
        $tgl_peminjaman_date = new DateTime($tgl_peminjaman_not_formated);
        $tanggal_peminjaman = $tgl_peminjaman_date->format('Y-m-d');

        $batas_peminjaman = $_POST['batasPengembalian'];
        $batas_peminjaman_date = new DateTime($batas_peminjaman_not_formated);
        $batas_peminjaman = $batas_peminjaman_date->format('Y-m-d');

        $kondisi_buku_saat_dipinjam = $_POST['kondisiBukuSaatDipinjam'];

        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE nama_anggota = '$nama_anggota' AND judul_buku = '$judul_buku' AND tanggal_pengembalian = ''");
        $cek = mysqli_num_rows($query);

        if ($cek > 0) {
            $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu telah meminjam buku ini sebelumnya !";
            header("location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $sql = "INSERT INTO peminjaman(nama_anggota,judul_buku,tanggal_peminjaman,batas_peminjaman,kondisi_buku_saat_dipinjam)
            VALUES('" . $nama_anggota . "','" . $judul_buku . "','" . $tanggal_peminjaman . "','" . $batas_peminjaman . "','" . $kondisi_buku_saat_dipinjam . "')";
            $sql .= mysqli_query($koneksi, $sql);

            // Send notif to admin
            InsertPemberitahuanPeminjaman();
            //

            if ($sql) {
                $_SESSION['berhasil'] = "Peminjaman buku berhasil !";
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['gagal'] = "Terjadi masalah dalam pengiriman data peminjaman !";
                header("location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
} elseif ($_GET['aksi'] == "pengembalian") {

    include "Pemberitahuan.php";

    $id_peminjaman = $_POST['judulBuku'];

    $tanggal_pengembalian_not_formated = $_POST['tanggalPengembalian'];
    $tanggal_pengembalian_date = new DateTime($tanggal_pengembalian_not_formated);
    $tanggal_pengembalian = $tanggal_pengembalian_date->format('Y-m-d');

    $kondisiBukuSaatDikembalikan = $_POST['kondisiBukuSaatDikembalikan'];

    $ambil_judul = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    $row = mysqli_fetch_assoc($ambil_judul);
    $judul_buku = $row['id_peminjaman'];

    $result = mysqli_query($koneksi, "SELECT batas_peminjaman FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    $row = mysqli_fetch_assoc($result);
    $data_batas_peminjaman = $row['batas_peminjaman'];
    $batas_peminjaman = $data_batas_peminjaman;

    $tanggalPengembalianDate = new DateTime($tanggal_pengembalian);
    $batasPeminjamanDate = new DateTime($batas_peminjaman);

    if ($tanggalPengembalianDate > $batasPeminjamanDate) {
        $interval = $batasPeminjamanDate->diff($tanggalPengembalianDate);
        $daysLate = $interval->format('%a'); // Get the difference in days
        $fine = $daysLate * 500; // 500 rupiah per day
        $denda_telat = $fine; // Store as number, no formatting
    } else {
        $denda_telat = 0;
    }

    if ($kondisiBukuSaatDikembalikan == "Baik") {
        $denda = 0 + $denda_telat;
    } elseif ($kondisiBukuSaatDikembalikan == "Rusak") {
        $denda = 20000 + $denda_telat;
    } elseif ($kondisiBukuSaatDikembalikan == "Hilang") {
        $denda = 50000 + $denda_telat;
    }

    if ($denda == 0) {
        $total_denda = "Tidak Ada";
    } else {
        $total_denda = "Rp " . number_format($denda, 0, ',', '.');
    }
    // print_r($interval);
    // print_r($id_peminjaman);
    // print_r($tanggal_pengembalian);
    // print_r($kondisiBukuSaatDikembalikan);
    // print_r($total_denda);

    $query = "UPDATE peminjaman SET tanggal_pengembalian = '$tanggal_pengembalian', kondisi_buku_saat_dikembalikan = '$kondisiBukuSaatDikembalikan', denda = '$total_denda'";
    $query .= "WHERE id_peminjaman = $id_peminjaman";
    echo "Query: " . $query . "<br>";

    $sql = mysqli_query($koneksi, $query);
    if ($sql) {
        // Send notif to admin
        InsertPemberitahuanPengembalian();

        $_SESSION['berhasil'] = "Pengembalian buku berhasil !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Pengembalian buku gagal !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
    // if (!$sql) {
    //     // Debugging statement for MySQL error
    //     echo "Error: " . mysqli_error($koneksi);
    //     $_SESSION['gagal'] = "Pengembalian buku gagal !";
    //     header("location: " . $_SERVER['HTTP_REFERER']);
    // } else {
    //     // Send notif to admin
    //     InsertPemberitahuanPengembalian();
    //     $_SESSION['berhasil'] = "Pengembalian buku berhasil !";
    //     header("location: " . $_SERVER['HTTP_REFERER']);
    // }
}

function UpdateDataPeminjaman()
{
    include "../../../../config/koneksi.php";

    $nama_lama = $_SESSION['fullname'];
    $nama_anggota = $_POST['Fullname'];

    // Mencari nama dalam database berdasarkan session nama lengkap
    $query1 = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname = '$nama_lama'");
    $row = mysqli_fetch_assoc($query1);

    // membuat variable dari hasil query1
    $nama_lama = $row['fullname'];

    // Fungsi update nama anggota pada table peminjaman
    $query = "UPDATE peminjaman SET nama_anggota = '$nama_anggota'";
    $query .= "WHERE nama_anggota = '$nama_lama'";

    $sql = mysqli_query($koneksi, $query);
}
