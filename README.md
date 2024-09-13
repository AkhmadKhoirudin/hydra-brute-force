# hydra-brute-force
Brute-force adalah metode serangan dalam keamanan siber yang melibatkan percobaan berulang-ulang untuk menebak informasi sensitif, seperti password, username, atau kunci enkripsi, hingga menemukan kombinasi yang benar. Dalam serangan brute-force, semua kemungkinan kombinasi diperiksa satu per satu, tanpa mengandalkan celah atau kerentanan selain mencoba setiap opsi yang mungkin.

# Hydra Brute-Force with Result Saving

This guide explains how to use Hydra for brute-force attack on an HTTP POST login form and save the valid username and password into a file.

Penjelasan:
hydra: Perintah Hydra untuk melakukan brute-force.
-L user.txt: File yang berisi daftar username.
-P pass.txt: File yang berisi daftar password.
-t 4: Menentukan jumlah thread (4 thread dalam hal ini).
-V: Mengaktifkan mode verbose untuk menampilkan proses brute-force secara terperinci.
192.168.1.2: Alamat IP target.
http-post-form: Menunjukkan metode serangan HTTP POST.
/pe/low.php: Path ke form login.
username=^USER^&password=^PASS^: Parameter form yang diisi oleh Hydra (username dan password).
:Login gagal. Username atau password salah.: String yang digunakan Hydra untuk mendeteksi kegagalan login.
| tee -a fixpassworddanuser.txt: Perintah ini digunakan untuk menyimpan output Hydra yang mengandung username dan password yang benar ke dalam file fixpassworddanuser.txt.
