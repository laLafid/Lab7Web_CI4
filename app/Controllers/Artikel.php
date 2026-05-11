<?php

namespace App\Controllers;
use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function getIndex()
    {
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $kategori_id = $this->request->getVar('kategori_id') ?? '';

        $builder = $model->select('artikel.*, kategori.nama_kategori')
                         ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
                         ->orderBy('artikel.created_at', 'DESC');

        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        return view('artikel/index', [
            'title'       => 'Daftar Artikel',
            'artikel'     => $builder->findAll(),
            'kategori'    => $kategoriModel->findAll(),
            'kategori_id' => $kategori_id
        ]);
    }
    public function getView($slug)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->select('artikel.*, kategori.nama_kategori')
                                 ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
                                 ->where('artikel.slug', $slug)
                                 ->first();
        if (empty($data['artikel'])) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data['title'] = $data['artikel']['judul'];
        return view('artikel/detail', $data);
    }
}