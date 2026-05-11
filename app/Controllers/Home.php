<?php
namespace App\Controllers;
use App\Models\KategoriModel;

class Home extends BaseController
{
    public function getIndex()
    {
        $model = new KategoriModel();
        return view('vi/home', [
            'title' => 'Home',
            'kategori' => $model->findAll()
        ]);
    }
}