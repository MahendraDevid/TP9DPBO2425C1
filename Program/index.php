<?php

include_once("models/DB.php");

// === 1. INCLUDE MODUL PEMBALAP ===
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

// === 2. INCLUDE MODUL MOBIL ===
include_once("models/TabelMobil.php");
include_once("views/ViewMobil.php");
include_once("presenters/PresenterMobil.php");

// === 3. INSTANSIASI OBJEK ===
// Pastikan parameter DB sesuai dengan database kamu
$tabelPembalap = new TabelPembalap('localhost', 'tp9_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenterPembalap = new PresenterPembalap($tabelPembalap, $viewPembalap);

$tabelMobil = new TabelMobil('localhost', 'tp9_db', 'root', '');
$viewMobil = new ViewMobil();
$presenterMobil = new PresenterMobil($tabelMobil, $viewMobil);


// === 4. TENTUKAN NAVIGASI (Default: pembalap) ===
$nav = $_GET['nav'] ?? 'pembalap';


// ==========================================================
// A. LOGIKA UTAMA: MOBIL
// ==========================================================
if ($nav == 'mobil') {

    // --- Handle POST (Simpan Data / Update Data) ---
    if (isset($_POST['action'])) {
        // Ambil data spesifik Mobil
        $nama = $_POST['nama_mobil'];
        $mesin = $_POST['merk_mesin'];
        $speed = $_POST['kecepatan_maks'];
        $berat = $_POST['berat_kg'];

        if ($_POST['action'] == 'add') {
            $presenterMobil->tambahMobil($nama, $mesin, $speed, $berat);
        } 
        else if ($_POST['action'] == 'update') {
            $id = $_POST['id'];
            $presenterMobil->ubahMobil($id, $nama, $mesin, $speed, $berat);
        }
        
        // Redirect kembali ke halaman Mobil
        header("Location: index.php?nav=mobil");
        exit();
    }

    // --- Handle GET Action (Delete) ---
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $presenterMobil->hapusMobil($_GET['id']);
        header("Location: index.php?nav=mobil");
        exit();
    }

    // --- Handle GET Screen (Tampilkan Form / List) ---
    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenterMobil->tampilkanFormMobil();
        } 
        else if ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenterMobil->tampilkanFormMobil($_GET['id']);
        }
    } 
    else {
        // Default: Tampilkan Tabel Mobil
        echo $presenterMobil->tampilkanMobil();
    }

} 

// ==========================================================
// B. LOGIKA UTAMA: PEMBALAP (Default)
// ==========================================================
else {

    // --- Handle POST (Simpan Data / Update Data) ---
    if (isset($_POST['action'])) {
        // Ambil data spesifik Pembalap
        $nama = $_POST['nama'];
        $tim = $_POST['tim'];
        $negara = $_POST['negara'];
        $poinMusim = $_POST['poinMusim'];
        $jumlahMenang = $_POST['jumlahMenang'];

        if ($_POST['action'] == 'add') {
            $presenterPembalap->tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        } 
        else if ($_POST['action'] == 'edit') { // Note: value di form harus 'edit' atau 'update' (samakan dengan View)
            $id = $_POST['id'];
            $presenterPembalap->ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        }

        // Redirect kembali ke halaman Pembalap
        header("Location: index.php");
        exit();
    }

    // --- Handle GET Action (Delete) ---
    // Logika delete biasanya via GET (link), bukan POST form, kecuali kamu pakai form khusus delete.
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) { // Perbaikan: Ganti $_POST jadi $_GET untuk delete link
        $presenterPembalap->hapusPembalap($_GET['id']);
        header("Location: index.php");
        exit();
    }

    // --- Handle GET Screen (Tampilkan Form / List) ---
    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenterPembalap->tampilkanFormPembalap();
        } 
        else if ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenterPembalap->tampilkanFormPembalap($_GET['id']);
        }
    } 
    else {
        // Default: Tampilkan Tabel Pembalap
        echo $presenterPembalap->tampilkanPembalap();
    }
}

?>