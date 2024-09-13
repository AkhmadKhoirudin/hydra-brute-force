# hydra-brute-force
Brute-force adalah metode serangan dalam keamanan siber yang melibatkan percobaan berulang-ulang untuk menebak informasi sensitif, seperti password, username, atau kunci enkripsi, hingga menemukan kombinasi yang benar. Dalam serangan brute-force, semua kemungkinan kombinasi diperiksa satu per satu, tanpa mengandalkan celah atau kerentanan selain mencoba setiap opsi yang mungkin.

# Hydra 
Hydra adalah alat brute-force yang digunakan untuk menguji kerentanannya dengan mencoba berbagai kombinasi username dan password untuk berbagai protokol atau layanan. Ini sering digunakan dalam pengujian keamanan untuk menemukan kredensial yang valid.
````
hydra -L user.txt -P pass.txt -t 4 -V 192.168.1.2 http-post-form "/pe/low.php:username=^USER^&password=^PASS^:Login gagal. Username atau password salah." | tee -a fixpassworddanuser.txt

````


## Penjelasan: <br>
**`hydra`**: Perintah Hydra untuk melakukan brute-force.<br>

**`-L`** user.txt: File yang berisi daftar username.<br>

**`-P`** pass.txt: File yang berisi daftar password.<br>



**`-t 4`**: Mengatur jumlah thread yang akan digunakan oleh Hydra untuk melakukan serangan. Dalam hal ini, 4 thread akan digunakan secara bersamaan. Menggunakan lebih banyak thread dapat mempercepat proses brute-force tetapi juga meningkatkan beban pada sistem target dan jaringan.<br>


**`-V`**: Mengaktifkan mode verbose untuk menampilkan proses brute-force secara terperinci.<br>

**`192.168.1.2`**: Alamat IP dari server target yang akan diuji. Hydra akan mengarahkan serangan brute-force ke server ini.<br>

**`http-post-form`**: Menunjukkan jenis serangan yang akan dilakukan, yaitu HTTP POST form. Hydra akan mengirimkan permintaan POST ke form login yang ditentukan.<br>

**`/pe/low.php`**: Path ke halaman login form pada server target.<br>

**`username=^USER^&password=^PASS^`**: Parameter form yang diisi oleh Hydra(username dan password). <br>

**`:Login gagal. Username atau password salah.`**: String yang digunakan Hydra untuk mendeteksi kegagalan login.<br>

**`| tee -a fixpassworddanuser.txt`**: Perintah ini digunakan untuk menyimpan output Hydra yang mengandung username dan password yang benar ke dalam file fixpassworddanuser.txt.<br>


<br>
<br>


# cara pengguna 
saya di sini mengunakan server localhost  yaitu xampp  pertama download folder **`pe`** lalu  simpan di folder xampp htdocs  contoh  **`C:\xampp1\htdocs`**
 jika sudah maka masuk ke system oprasi linux <br>
 di linux alian simpan folder **`user dan password`** di linux yang penting file  pass.txt dan user.txt muda di jangkau <br>
 lalu kita mulai penetrasi server  pastikan server on jika suda buka terminal  sadisini mengunakan  **`kali linux`**
 ````
sudo apt update <br>
sudo apt install hydra

 ````

jika suda launjutmengamati target reaksi yang di timbul  contohnya pada **`pe/low.php`** kerika terjadi kesalanhan akan timbul pesan **`:Login gagal. Username atau password salah.`** kita dapat memanfatakan fungs **`curl`** sebagai berikut <br>
````
curl -X POST -d "username=admin&password=admi" http://192.168.1.2/pe/low.php
````

jika suda mendapatakan target yanng d tentukan maka launjut menyesuaikan **`hydra -L user.txt -P pass.txt -t 4 -V 192.168.1.2 http-post-form "/pe/low.php:username=^USER^&password=^PASS^:Login gagal. Username atau password salah." | tee -a fixpassworddanuser.txt`**

dan tunggu proseser penetrasi sampai selesai 
 
