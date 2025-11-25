<?php
interface KontrakPresenterMobil
{
    // Menampilkan daftar mobil
    public function tampilkanMobil(): string;

    // Menampilkan form mobil
    public function tampilkanFormMobil($id = null): string;

    // CRUD Mobil (Sesuai kolom di database: nama, mesin, speed, berat)
    public function tambahMobil($nama, $mesin, $speed, $berat): void;
    public function ubahMobil($id, $nama, $mesin, $speed, $berat): void;
    public function hapusMobil($id): void;
}

?>