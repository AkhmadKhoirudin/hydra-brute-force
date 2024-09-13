<?php
// Koneksi ke MySQL
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
        username VARCHAR(30) NOT NULL UNIQUE,
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
    // Ambil data dari form input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi apakah username dan password tidak kosong
    if (empty($username) || empty($password)) {
        $message = "Username dan password tidak boleh kosong.";
    } else {
        // Cek apakah username sudah ada
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $message = "Username sudah terdaftar. Silakan gunakan username lain.";
        } else {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan user baru ke tabel
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $message = "Pendaftaran berhasil!";
            } else {
                $message = "Gagal mendaftarkan user: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
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
