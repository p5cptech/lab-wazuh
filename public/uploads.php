<?php
// Tampilkan error PHP untuk mempermudah debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Upload Foto Profil (Lab Version)</h2>";
echo '<form action="" method="post" enctype="multipart/form-data">
        Pilih file: <input type="file" name="file">
        <input type="submit" value="Upload" name="submit">
      </form>';

if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    
    // CEK 1: Apakah folder ada?
    if (!is_dir($target_dir)) {
        die("Error: Folder '$target_dir' tidak ditemukan. Silakan buat folder tersebut.");
    }

    // CEK 2: Apakah folder bisa ditulis?
    if (!is_writable($target_dir)) {
        die("Error: Folder '$target_dir' tidak memiliki izin tulis (Permission Denied).");
    }

    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Proses Upload
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "<p style='color:green'>File berhasil diunggah ke: <a href='$target_file'>$target_file</a></p>";
    } else {
        echo "<p style='color:red'>Maaf, terjadi error teknis saat memindahkan file.</p>";
        print_r($_FILES['file']['error']); // Menampilkan kode error upload PHP
    }
}
?>