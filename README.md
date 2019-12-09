# Flip-CLI

>**Flip-CLI** adalah PHP-CLI microframework yang dibuat menggunakan Vanilla PHP (tanpa external library atau kustomisasi) untuk menyelesaikan technical test Backend Developer Flip.id.

### Installation

-  Buat database baru di komputer Anda, misal dengan nama `db_flip_cli`
-  Jalankan perintah `composer dump-autoload` untuk generate autoload file agar comply dengan [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/).
Jika `composer` belum ter-install di komputer Anda, silakan ikuti [panduan berikut](https://getcomposer.org/download/).
- Sesuaikan credential database Anda pada file `config.php`

```
'database' => [
    'db_name' => '[YOUR-DB-NAME]',
    'db_username' => '[YOUR-DB-USERNAME]',
    'db_password' => '[YOUR-DB-PASSWORD]',
    'db_connection' => 'mysql:host=127.0.0.1'
]
```
- Masuk ke directory project dan jalankan perintah `php flip db_migrate` untuk generate tabel `disbursements`

### Usage 

##### `php flip [COMMAND] [OPTIONS-PARAMS]`

#### 1. Hello World!
Perintah percobaan untuk memastikan **Flip-CLI** sudah berhasil di-install jika tidak muncul pesan kesalahan satu pun.

Contoh Penggunaan 

`php flip hello`

`php flip hello --name="Wahyu Rismawan"`

#### 2. Help Command
Perintah untuk memunculkan seluruh `command` yang tersedia di dalam **Flip-CLI**

`php flip help`

#### 3. Send Disbursement Command
Mengirim permintaan data disbursement ke Slightly-Big Flip API dan menyimpannya ke dalam database.

Contoh penggunaan: 

`php flip disbursement send --bank_code=021 --account_number=111-222-333 --amount=10000 --remark="sample remark"`

#### 4. Show Disbursement Data By Id Command
Melakukan pengecekan status permintaan `disbursement` ke Slightky-Big API dan memperbarui datanya di local database jika ada perubahan.

Contoh Penggunaan: `php flip disbursement show --id=123456`
 
#### 5. Show All Disbursement Data Command
Menampilkan seluruh data `disbursement` yang ada di local database.

Contoh Penggunaan: `php flip disbursement all`
