<?php

interface KontrakViewMobil
{
    public function tampilMobil($listMobil): string;
    public function tampilFormMobil($data = null): string;
}

?>