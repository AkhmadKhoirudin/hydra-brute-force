<?php
// Koneksi ke MySQL tanpa menyebutkan database
$conn = new mysqli("localhost", "root", "");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Nama database yang akan digunakan
$dbname = "testdb";

// Cek apakah database sudah ada
$sql = "SHOW DATABASES LIKE '$dbname'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Jika database belum ada, buat database
    $sql = "CREATE DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database '$dbname' berhasil dibuat.<br>";
    } else {
        die("Gagal membuat database: " . $conn->error);
    }
} else {
    echo "Database '$dbname' sudah ada.<br>";
}

// Pilih database yang sudah ada atau baru dibuat
$conn->select_db($dbname);

// Cek apakah tabel 'users' ada
$sql = "SHOW TABLES LIKE 'users'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Jika tabel 'users' belum ada, buat tabel
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Tabel 'users' berhasil dibuat.<br>";
    } else {
        die("Gagal membuat tabel: " . $conn->error);
    }
} else {
    echo "Tabel 'users' sudah ada.<br>";
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Masukkan user baru ke tabel
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Pendaftaran berhasil!";
    } else {
        $message = "Gagal mendaftarkan user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Form Pendaftaran</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Daftar">
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
