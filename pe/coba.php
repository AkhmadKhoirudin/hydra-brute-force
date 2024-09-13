<?php
// Koneksi ke MySQL
$conn = new mysqli("localhost", "root", "", "testdb");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari form login
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validasi apakah input username dan password tidak kosong
    if (empty($username) || empty($password)) {
        $message = "Username dan password tidak boleh kosong.";
    } else {
        // Gunakan prepared statement untuk mencegah SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Jika username ditemukan
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Jika password benar
                $message = "Login berhasil! Selamat datang, " . htmlspecialchars($username) . ".";
            } else {
                // Jika password salah
                $message = "Login gagal. Password salah.";
            }
        } else {
            // Jika username tidak ditemukan
            $message = "Login gagal. Username tidak ditemukan.";
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
    <title>Login</title>
</head>
<body>
    <h2>Form Login</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
