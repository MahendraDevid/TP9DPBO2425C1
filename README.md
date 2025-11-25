# Janji
Saya Mahendra Devid Putra Anwar mengerjakan evaluasi Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program (Arsitektur MVP)
Program ini memisahkan kode menjadi tiga lapisan utama:

1. Model
Fungsi: Bertanggung jawab penuh atas manajemen data dan komunikasi langsung dengan database.

File: TabelPembalap.php, TabelMobil.php.

Tugas: Melakukan query SQL (SELECT, INSERT, UPDATE, DELETE) dan mengembalikan data dalam bentuk Array atau Objek.

2. View
Fungsi: Bertanggung jawab untuk menampilkan antarmuka kepada pengguna. View tidak boleh memiliki logika bisnis yang rumit.

File: ViewPembalap.php, ViewMobil.php.

Tugas: Membaca file template HTML dari folder templates/, lalu mengganti placeholder (seperti ``) dengan data aktual yang diterima dari Presenter.

3. Presenter
Fungsi: Bertindak sebagai jembatan (perantara) antara Model dan View.

File: PresenterPembalap.php, PresenterMobil.php.

Tugas: 1. Menerima perintah dari index.php. 2. Meminta data dari Model. 3. Memformat data tersebut jika perlu. 4. Mengirimkan data ke View untuk ditampilkan.

# Alur Program
Program dikendalikan melalui satu pintu masuk yaitu index.php.

1. Navigasi Antar Modul
Pengguna memilih menu "Pembalap" atau "Mobil Balap".

index.php mengecek parameter URL ?nav=mobil.

Jika ada, program memuat PresenterMobil.

Jika tidak (default), program memuat PresenterPembalap.

2. Melihat Data (Read)
index.php memanggil method tampilkanPembalap() atau tampilkanMobil() pada Presenter.

Presenter mengambil data dari Model (getAll...).

Presenter mengirim data ke View.

View merender file skin.html atau skin_mobil.html.

3. Menambah Data (Create)
Buka Form: Pengguna klik tombol "Tambah". URL menuju index.php?screen=add. View memuat form.html.

Simpan Data: Pengguna mengisi form dan klik "Simpan". Form mengirim data via POST.

index.php mendeteksi $_POST['action'] == 'add'.

Data dikirim ke Presenter -> Model -> Database.

Halaman di-redirect kembali ke daftar utama.

4. Mengedit Data (Update)
Buka Form: Pengguna klik tombol "Edit". URL menuju index.php?screen=edit&id=X.

Presenter meminta Model mengambil data spesifik berdasarkan ID.

View mengisi form (form.html) dengan data lama (pre-fill).

Update Data: Saat disubmit, index.php mendeteksi $_POST['action'] == 'update'. Data diperbarui di database.

5. Menghapus Data (Delete)
Pengguna mengklik tombol "Hapus" (muncul konfirmasi JavaScript).

Browser mengirim permintaan ke index.php?action=delete&id=X.

# DOkumentasi
https://github.com/user-attachments/assets/55a3dccb-11c7-4a20-994d-8bf757349d1d



Presenter memerintahkan Model untuk menghapus baris dengan ID tersebut.

Halaman di-redirect kembali ke daftar utama.
