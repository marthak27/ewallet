###################
Mini E-Wallet
###################

Menggunakan Framework codeigniter3 dan MySQL

*******************
Cara menjalankan Framework
*******************

1. Download / clone repo ini 
2. Copy dan Paste Folder ewallet ke dalam folder htdocs
3. Setting XAMPP Control panel dan start apache dan MySQL
4. Import database ewallet di XAMPP (localhost/phpmyadmin) yang ada di dalam folder ewallet->application->database
5. Tes API dengan postman :

API Registration :
- method POST - localhost/ewallet/api/authentication/registration 
- Pilih x-www-form-urlencoded
- isi Body dengan field username, email dan password
- Klik Send

API login :
- method POST - localhost/ewallet/api/authentication/login
- Pilih x-www-form-urlencoded
- isi Body dengan field email dan password
- Klik Send

API logout :
- method GET - localhost/ewallet/api/authentication/login
- Klik Send

API user edit :
- method PUT - localhost/ewallet/api/authentication/user
- Pilih x-www-form-urlencoded
- isi Body dengan id dan field lain (username/password/email) yang akan diubah 
- Klik Send

API user detail by ID :
- method GET - localhost/ewallet/api/authentication/user/nomorID
- Klik Send
