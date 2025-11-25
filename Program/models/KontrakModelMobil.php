<?php

/*
    Interface KontrakModelMobil
    Berfungsi sebagai kontrak untuk memanipulasi data Mobil.
    Setiap class yang menggunakan interface ini WAJIB memiliki fungsi-fungsi di bawah.
*/

interface KontrakModelMobil
{
    // Mengambil data (Read)
    public function getAllMobil(): array;
    public function getMobilById($id): ?array;

    // Method manipulasi data (CUD)
    public function addMobil($nama, $mesin, $speed, $berat): void;
    public function updateMobil($id, $nama, $mesin, $speed, $berat): void;
    public function deleteMobil($id): void;
}

?>