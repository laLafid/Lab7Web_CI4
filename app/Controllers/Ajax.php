<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\Response;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Ajax extends Controller
{
    public function getIndex()
    {
        $title = 'Daftar Artikel (Admin)';
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('ajax/index', compact('title', 'kategori'));
    }

    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->getArtikelDenganKategori();
        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }

    public function postAdd()
    {
        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            'gambar'      => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp,video/mp4]|max_size[gambar,20480]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'Error', 'errors' => $this->validator->getErrors()]);
        }

        $file = $this->request->getFile('gambar');
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'gambar/app', $newName);

        $model = new ArtikelModel();
        $model->insert([
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'slug'        => url_title($this->request->getPost('judul') ?? '', '-', true),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'gambar'      => $newName,
        ]);

        return $this->response->setJSON(['status' => 'OK', 'message' => 'Artikel berhasil ditambahkan!']);
    }

    public function getDetail($id)
    {
        $model = new ArtikelModel();
        return $this->response->setJSON($model->find($id));
    }

    public function postUpdate($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);

        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            'gambar'      => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp,video/mp4]|max_size[gambar,20480]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'Error', 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'id_kategori' => $this->request->getPost('id_kategori')
        ];

        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($artikel['gambar']) && file_exists(FCPATH . 'gambar/app/' . $artikel['gambar'])) {
                unlink(FCPATH . 'gambar/app/' . $artikel['gambar']);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'gambar/app', $newName);
            $data['gambar'] = $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'OK', 'message' => 'Artikel berhasil diperbarui!']);
    }

    public function getDelete($id)
    {
        $model = new ArtikelModel();
        $data = $model->delete($id);
        $data = [
            'status' => 'OK'
        ];
        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }
}