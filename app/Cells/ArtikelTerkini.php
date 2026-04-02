<?php
namespace App\Cells;
use App\Models\ArtikelModel;
class ArtikelTerkini
{
        public function render(string $kategori = 'umum')
    {
        $model = new ArtikelModel();
        $artikel = $model
            ->where('kategori', $kategori)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('components/artikel_terkini', [
            'artikel'   => $artikel,
            'kategori'  => $kategori
        ]);
    }
}