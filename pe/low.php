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
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari user tanpa real_escape_string atau prepared statements
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query rentan terhadap SQL Injection
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Login berhasil!";
    } else {
        $message = "Login gagal. Username atau password salah.";
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
    <h2>Form Login low</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
