<?php

include_once("KontrakViewMobil.php");
include_once("models/Mobil.php");

class ViewMobil implements KontrakViewMobil {

    public function __construct(){
        // Kosong
    }

    public function tampilMobil($listMobil): string {
        $tbody = '';
        $no = 1;
        
        // 1. Loop data dari database untuk membuat baris tabel HTML
        foreach($listMobil as $mobil){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td><b>'. htmlspecialchars($mobil->nama_mobil) .'</b></td>';
            $tbody .= '<td>'. htmlspecialchars($mobil->merk_mesin) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($mobil->kecepatan_maks) . ' km/h</td>';
            $tbody .= '<td>'. htmlspecialchars($mobil->berat_kg) . ' kg</td>';
            $tbody .= '<td class="col-actions">
                        <a href="index.php?nav=mobil&screen=edit&id='. $mobil->id .'" class="btn btn-edit">Edit</a>
                        <button data-id="'. $mobil->id .'" class="btn btn-delete">Hapus</button>
                      </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // 2. Load template skin_mobil.html
            $templatePath = __DIR__ . '/../template/skin_mobil.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // 3. Ganti penanda dengan isi $tbody
            // Teks di dalam tanda kutip HARUS SAMA PERSIS dengan yang di file HTML
                $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            
            // Update total data
            $total = count($listMobil);
            $template = str_replace('Total:', 'Total Unit: ' . $total, $template);
            
            return $template;
        }

        // Fallback jika template tidak ditemukan (untuk debug)
        return "Template tidak ketemu! <br> <table border='1'>$tbody</table>";
    }

    public function tampilFormMobil($data = null): string {
        // ... kode form (tidak perlu diubah) ...
            $templatePath = __DIR__ . '/../template/form_mobil.html';
        $template = file_get_contents($templatePath);
        
        if ($data) {
            // Ubah mode form jadi 'update'
            $template = str_replace('value="add"', 'value="update"', $template);

            // Sisipkan nilai ke atribut value untuk input berdasarkan atribut name.
            // Gunakan preg_replace agar tidak tergantung pada urutan atribut di file HTML.
            $fields = [
                'id' => $data['id'] ?? '',
                'nama_mobil' => htmlspecialchars($data['nama_mobil'] ?? ''),
                'merk_mesin' => htmlspecialchars($data['merk_mesin'] ?? ''),
                'kecepatan_maks' => htmlspecialchars($data['kecepatan_maks'] ?? ''),
                'berat_kg' => htmlspecialchars($data['berat_kg'] ?? '')
            ];

            foreach ($fields as $name => $val) {
                // Ganti value="" pada input yang memiliki name="$name"
                $pattern = '/(<input[^>]*name="' . preg_quote($name, '/') . '"[^>]*?)value=""/i';
                $replacement = '$1value="' . $val . '"';
                $template = preg_replace($pattern, $replacement, $template);
            }
        }
        return $template;
    }
}
?>