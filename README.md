# hydra-brute-force
Brute-force adalah metode serangan dalam keamanan siber yang melibatkan percobaan berulang-ulang untuk menebak informasi sensitif, seperti password, username, atau kunci enkripsi, hingga menemukan kombinasi yang benar. Dalam serangan brute-force, semua kemungkinan kombinasi diperiksa satu per satu, tanpa mengandalkan celah atau kerentanan selain mencoba setiap opsi yang mungkin.

# Hydra Brute-Force with Result Saving

This guide explains how to use Hydra for brute-force attack on an HTTP POST login form and save the valid username and password into a file.

Penjelasan:
hydra: Perintah Hydra untuk melakukan brute-force.<br>
-L user.txt: File yang berisi daftar username.<br>
-P pass.txt: File yang berisi daftar password.<br>
**`-t 4`**: Menentukan jumlah thread (4 thread dalam hal ini).<br>
-V: Mengaktifkan mode verbose untuk menampilkan proses brute-force secara terperinci.<br>
192.168.1.2: Alamat IP target.<br>
http-post-form: Menunjukkan metode serangan HTTP POST.<br>
/pe/low.php: Path ke form login.<br>
username=^USER^&password=^PASS^: Parameter form yang diisi oleh Hydra 
(username dan password). <br>:Login gagal. Username atau password salah.: String yang digunakan Hydra untuk mendeteksi kegagalan login.<br>
| tee -a fixpassworddanuser.txt: Perintah ini digunakan untuk menyimpan output Hydra yang mengandung username dan password yang benar ke dalam file fixpassworddanuser.txt.
