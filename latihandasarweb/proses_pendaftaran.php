<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Biasanya password dienkripsi sebelum disimpan
    $jenis_kelamin = $_POST['jenis_kelamin_select'];
    $tingkat_pendidikan = $_POST['tingkat_pendidikan'];
    $hobi = implode(", ", $_POST['hobi']); // Gabungkan array hobi menjadi string

    // Baca isi file dan cek apakah email sudah ada
    $file_name = "pendaftaran_data.txt";
    $file = fopen($file_name, "r");
    $is_duplicate = false;

    while (($line = fgets($file)) !== false) {
        // Cek apakah email sudah ada dalam setiap baris file
        if (strpos($line, "Email: $email") !== false) {
            $is_duplicate = true;
            break;
        }
    }
    fclose($file);

    if ($is_duplicate) {
        // Jika duplikat ditemukan, tampilkan pesan
        echo "Pendaftaran gagal. Email sudah terdaftar.";
    } else {
        // Format data yang akan disimpan
        $data = "Nama Depan: $nama_depan, Nama Belakang: $nama_belakang, Email: $email, Password: $password, Jenis Kelamin: $jenis_kelamin, Tingkat Pendidikan: $tingkat_pendidikan, Hobi: $hobi\n";

        // Simpan data ke file .txt
        $file = fopen($file_name, "a"); // 'a' untuk menambahkan data di akhir file
        fwrite($file, $data);
        fclose($file);

        // Redirect ke halaman data.html setelah data disimpan
        header("Location: data.php");
        exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
    }
}
?>
