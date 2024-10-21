<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--
    
   <link rel="stylesheet" href="data.css?v=1.0">
   
   -->

    <title>Data Pendaftar</title>
    
</head>
<body>

    <h1>Data Pendaftar</h1>

    <table border="2">
        <thead>
            <tr>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Email</th>
                <th>Password</th>
                <th>Jenis Kelamin</th>
                <th>Tingkat Pendidikan</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Nama file yang berisi data
            $file_name = "pendaftaran_data.txt";

            // Pastikan file ada sebelum dibaca
            if (file_exists($file_name)) {
                $file = fopen($file_name, "r");  //read

                // Loop melalui setiap baris data dalam file
                while (($line = fgets($file)) !== false) {
                    // Pisahkan data berdasarkan pemisah koma
                    $data = explode(", Hobi: ", $line); // Pisahkan bagian hobi dengan pemisah yang tepat
                    
                    // Data umum (Nama Depan, Nama Belakang, Email, dll.)
                    $details = explode(", ", $data[0]);
                    // Bagian hobi (tidak dipecah lagi)
                    $hobi = isset($data[1]) ? $data[1] : ''; // Pastikan ada bagian hobi
                    
                    echo "<tr>";
                    // Tampilkan data umum
                    foreach ($details as $cell) {
                        $cell_data = explode(": ", $cell);
                        if (count($cell_data) == 2) {
                            // Cek apakah kolom tersebut adalah password
                            if (strpos($cell_data[0], "Password") !== false) {
                                echo "<td>****</td>"; // Ganti password dengan ****
                            } else {
                                echo "<td>" . htmlspecialchars($cell_data[1]) . "</td>";
                            }
                        }
                    }
                    // Tampilkan hobi
                    echo "<td>" . htmlspecialchars($hobi) . "</td>";
                    echo "</tr>";
                }

                fclose($file);
            } else {
                echo "<tr><td colspan='7'>Belum ada data pendaftar.</td></tr>";
            }
            ?>

        </tbody>
    </table>

    <!-- Tombol Kembali ke Halaman Index -->
    <button onclick="window.location.href='index.html'">Kembali ke Formulir</button>

</body>
</html>
