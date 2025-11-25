<?php

include_once("DB.php");
include_once("KontrakModelMobil.php");

class TabelMobil extends DB implements KontrakModelMobil {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // --- Implementasi Method dari Interface (Read) ---

    public function getAllMobil(): array {
        $query = "SELECT * FROM mobil";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getMobilById($id): ?array {
        $query = "SELECT * FROM mobil WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    // --- Implementasi Method dari Interface (CUD) ---

    public function addMobil($nama, $mesin, $speed, $berat): void {
        $query = "INSERT INTO mobil (nama_mobil, merk_mesin, kecepatan_maks, berat_kg) 
                  VALUES (:nama, :mesin, :speed, :berat)";
        
        $params = [
            'nama' => $nama,
            'mesin' => $mesin,
            'speed' => $speed,
            'berat' => $berat
        ];

        $this->executeQuery($query, $params);
    }

    public function updateMobil($id, $nama, $mesin, $speed, $berat): void {
        $query = "UPDATE mobil 
                  SET nama_mobil = :nama, 
                      merk_mesin = :mesin, 
                      kecepatan_maks = :speed, 
                      berat_kg = :berat 
                  WHERE id = :id";
        
        $params = [
            'id' => $id,
            'nama' => $nama,
            'mesin' => $mesin,
            'speed' => $speed,
            'berat' => $berat
        ];

        $this->executeQuery($query, $params);
    }

    public function deleteMobil($id): void {
        $query = "DELETE FROM mobil WHERE id = :id";
        
        $params = [
            'id' => $id
        ];

        $this->executeQuery($query, $params);
    }
}

?>