<?php

include_once(__DIR__ . "/KontrakPresenterMobil.php"); // Pastikan ini mengarah ke file Kontrak di atas
include_once(__DIR__ . "/../models/TabelMobil.php");
include_once(__DIR__ . "/../models/Mobil.php");
include_once(__DIR__ . "/../views/ViewMobil.php");

class PresenterMobil implements KontrakPresenterMobil
{
    // Instance Model & View
    private $tabelMobil;
    private $viewMobil;

    // Data list mobil
    private $listMobil = [];

    // Konstruktor
    public function __construct($tabelMobil, $viewMobil)
    {
        $this->tabelMobil = $tabelMobil;
        $this->viewMobil = $viewMobil;
        $this->initListMobil(); // Load data saat awal dibuat
    }

    // Mengambil data dari DB dan mengubahnya menjadi Objek Mobil
    public function initListMobil()
    {
        $data = $this->tabelMobil->getAllMobil();

        $this->listMobil = [];
        foreach ($data as $item) {
            $mobil = new Mobil(
                $item['id'],
                $item['nama_mobil'],
                $item['merk_mesin'],
                $item['kecepatan_maks'],
                $item['berat_kg']
            );
            $this->listMobil[] = $mobil;
        }
    }

    // --- IMPLEMENTASI METHOD DARI KONTRAK ---

    public function tampilkanMobil(): string
    {
        return $this->viewMobil->tampilMobil($this->listMobil);
    }

    public function tampilkanFormMobil($id = null): string
    {
        $data = null;
        if ($id !== null) {
            // Ambil satu data untuk diedit
            $data = $this->tabelMobil->getMobilById($id);
        }
        return $this->viewMobil->tampilFormMobil($data);
    }

    // Logika Tambah
    public function tambahMobil($nama, $mesin, $speed, $berat): void {
        $this->tabelMobil->addMobil($nama, $mesin, $speed, $berat);
        $this->initListMobil();
    }
    
    // Logika Ubah
    public function ubahMobil($id, $nama, $mesin, $speed, $berat): void {
        $this->tabelMobil->updateMobil($id, $nama, $mesin, $speed, $berat);
        $this->initListMobil();
    }
    
    // Logika Hapus
    public function hapusMobil($id): void {
        $this->tabelMobil->deleteMobil($id);
        $this->initListMobil();
    }
}

?>