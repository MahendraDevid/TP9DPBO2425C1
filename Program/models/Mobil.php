<?php
class Mobil
{
    public $id;
    public $nama_mobil;
    public $merk_mesin;
    public $kecepatan_maks;
    public $berat_kg;

    public function __construct($id, $nama_mobil, $merk_mesin, $kecepatan_maks, $berat_kg)
    {
        $this->id = $id;
        $this->nama_mobil = $nama_mobil;
        $this->merk_mesin = $merk_mesin;
        $this->kecepatan_maks = $kecepatan_maks;
        $this->berat_kg = $berat_kg;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNamaMobil()
    {
        return $this->nama_mobil;
    }
    public function getMerkMesin()
    {
        return $this->merk_mesin;
    }
    public function getKecepatanMaks()
    {
        return $this->kecepatan_maks;
    }
    public function getBeratKg()
    {
        return $this->berat_kg;
    }

    public function setNamaMobil($nama_mobil)
    {
        $this->nama_mobil = $nama_mobil;
    }
    public function setMerkMesin($merk_mesin)
    {
        $this->merk_mesin = $merk_mesin;
    }
    public function setKecepatanMaks($kecepatan_maks)
    {
        $this->kecepatan_maks = $kecepatan_maks;
    }
    public function setBeratKg($berat_kg)
    {
        $this->berat_kg = $berat_kg;
    }
}
?>