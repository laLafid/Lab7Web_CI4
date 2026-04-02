<?php
namespace App\Controllers;
use App\Models\ArtikelModel;
use CodeIgniter\Router\Attributes\Filter;

#[Filter(by: 'auth')]
class Admin extends BaseController
{
    public function getIndex()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/admin_index', compact('artikel', 'title'));
    }
    public function getAdd()
    {
        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }
    public function postAdd()
    {
        // validasi data. 
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul')),
                'kategori' => $this->request->getPost('kategori'), 
            ]);
            return redirect()->to('/admin')->with('success', 'Data di tambah!');
        }
    }
    public function getEdit($id)
    {
        $artikel = new ArtikelModel();
        // ambil data lama
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }
    public function postEdit($id)
    {
        $artikel = new ArtikelModel();
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'kategori' => $this->request->getPost('kategori'),
            ]);
            return redirect()->to('/admin')->with('success', 'Data di update!');
        }
    }
    public function getDelete($id)
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect()->to('/admin')->with('success', 'Data di hapus!');
    }

}