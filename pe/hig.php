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
        username VARCHAR(30) NOT NULL UNIQUE,
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
    // Menggunakan filter_input untuk sanitasi
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Dapatkan hasil
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            $message = "Login berhasil!";
        } else {
            $message = "Login gagal. Password salah.";
        }
    } else {
        $message = "Login gagal. Username tidak ditemukan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Form Login hig</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
