<?php
$mysqli = new mysqli("localhost", "root", "", "daily_nutri");

if ($mysqli->connect_errno) {
    echo "❌ Gagal konek MySQL: " . $mysqli->connect_error;
} else {
    echo "✅ Koneksi MySQL berhasil!";
}
?>
