<?php
function GetBadgePesan()
{
    echo '<i class="fa fa-envelope-o"></i>';
    include "../../../../config/koneksi.php";

    $nama_saya = $_SESSION['fullname'];
    $default = "Belum dibaca";
    $query_pesan = mysqli_query($koneksi, "SELECT * FROM pesan WHERE penerima = '$nama_saya' AND status = '$default'");

    if (!$query_pesan) {
        // Handle query error
        echo "Error: " . mysqli_error($koneksi);
        return;
    }

    $jumlah_pesan = mysqli_num_rows($query_pesan);

    if ($jumlah_pesan == 0) {
        // Hilangkan badge pesan
    } else {
        echo "<span class='label label-danger'>" . $jumlah_pesan . "</span>";
    }
}

function GetPesan()
{
    echo "<li class='header'>";
    include "../../../../config/koneksi.php";

    $nama_saya = $_SESSION['fullname'];
    $default = "Belum dibaca";
    $query_pesan = mysqli_query($koneksi, "SELECT * FROM pesan WHERE penerima = '$nama_saya' AND status = '$default'");

    if (!$query_pesan) {
        // Handle query error
        echo "Error: " . mysqli_error($koneksi);
        return;
    }

    $jumlah_pesan = mysqli_num_rows($query_pesan);

    if ($jumlah_pesan == 0) {
        echo "Kamu tidak memiliki pesan baru";
    } else {
        echo "Kamu memiliki $jumlah_pesan pesan";
    }

    echo "</li>";

    echo "<li>";
    echo "<ul class='menu'>";

    $query_pesan1 = mysqli_query($koneksi, "SELECT * FROM pesan WHERE penerima = '$nama_saya' AND status = '$default' LIMIT 3");

    if (!$query_pesan1) {
        // Handle query error
        echo "Error: " . mysqli_error($koneksi);
        return;
    }

    while ($row_pesan1 = mysqli_fetch_assoc($query_pesan1)) {
        echo "<a href='pages/function/Pesan.php?aksi=update&id_pesan=" . $row_pesan1['id_pesan'] . "'>";
        echo "<div class='pull-left'>";
        echo "<img src='../../assets/dist/img/avatar.png' class='img-circle' alt='User Image'>";
        echo "</div>";
        echo "<h4 style='font-family: Quicksand, sans-serif'>";

        $nama = $row_pesan1['pengirim'];
        $query_cek_verif = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname = '$nama'");

        if (!$query_cek_verif) {
            // Handle query error
            echo "Error: " . mysqli_error($koneksi);
            return;
        }

        $row_cek = mysqli_fetch_array($query_cek_verif);
        if ($row_cek['verif'] == "Tidak") {
            echo "$row_pesan1[pengirim]";
        } elseif ($row_cek['verif'] == "Iya") {
            echo "$row_pesan1[pengirim] <i class='fa fa-check-circle text-info' title='User Terverifikasi' data-toggle='tooltip' data-placement='bottom'></i>";
        } else {
            echo "$row_pesan1[pengirim]";
        }

        echo "</h4>";
        echo "<p>" . $row_pesan1['isi_pesan'] . "</p>";
        echo "</a>";
    }
    echo "</li>";
    echo "</ul>";
    echo "<li class='footer'><a href='pesan'>Lihat semua pesan</a></li>";
}

function GetJumlahPesan()
{
    include "../../../../config/koneksi.php";

    $nama_saya = $_SESSION['fullname'];
    $default = "Belum dibaca";
    $query_pesan = mysqli_query($koneksi, "SELECT * FROM pesan WHERE penerima = '$nama_saya' AND status = '$default'");

    if (!$query_pesan) {
        // Handle query error
        echo "Error: " . mysqli_error($koneksi);
        return;
    }

    $jumlah_pesan = mysqli_num_rows($query_pesan);

    if ($jumlah_pesan == 0) {
        // Hilangkan badge pesan
    } else {
        echo "<span class='label label-danger pull-right'>" . $jumlah_pesan . "</span>";
    }
}
