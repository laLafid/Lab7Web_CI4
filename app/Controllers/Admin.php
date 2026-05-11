<?php
namespace App\Controllers;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Router\Attributes\Filter;

#[Filter(by: 'auth')]
class Admin extends BaseController
{
    public function getIndex()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new ArtikelModel();

        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';

        $data = [
            'title'      => $title,
            'q'          => $q,
            'kategori_id'=> $kategori_id,
        ];

        $builder = $model->table('artikel')
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        $data['artikel'] = $builder->paginate(5);
        $data['pager']   = $model->pager;

        $kategoriModel   = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('artikel/admin_index', $data);
    }

    public function getAdd()
    {
        $kategoriModel = new KategoriModel();
        return view('artikel/form_add', [
            'title'   => 'Tambah Artikel',
            'kategori'=> $kategoriModel->findAll(),
        ]);
    }

    public function postAdd()
    {
        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            'gambar'      => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp,video/mp4]|max_size[gambar,20480]'
        ];

        if ($this->validate($rules)) {
            $file = $this->request->getFile('gambar');
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'gambar/app', $newName);

            $model = new ArtikelModel();
            $model->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title($this->request->getPost('judul'), '-', true),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => $newName,
            ]);
            return redirect()->to('/admin')->with('success', 'Artikel berhasil ditambahkan!');
        }
        return redirect()->back()->withInput();
    }

    public function getEdit($id)
    {
        $model         = new ArtikelModel();
        $kategoriModel = new KategoriModel();
        return view('artikel/form_edit', [
            'title'   => 'Edit Artikel',
            'artikel' => $model->find($id),
            'kategori'=> $kategoriModel->findAll(),
        ]);
    }

    public function postEdit($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);

        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            'gambar'      => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp,video/mp4]|max_size[gambar,20480]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori')
            ];

            $file = $this->request->getFile('gambar');
            if ($file->isValid() && !$file->hasMoved()) {
                // Hapus gambar lama jika ada di server
                if (!empty($artikel['gambar']) && file_exists(FCPATH . 'gambar/app/' . $artikel['gambar'])) {
                    unlink(FCPATH . 'gambar/app/' . $artikel['gambar']);
                }

                $newName = $file->getRandomName();
                $file->move(FCPATH . 'gambar/app', $newName);
                $data['gambar'] = $newName;
            }

            $model->update($id, $data);
            return redirect()->to('/admin')->with('success', 'Artikel berhasil diperbarui!');
        }
        return redirect()->back()->withInput();
    }

    public function getDelete($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);
        if ($artikel && !empty($artikel['gambar'])) {
            $path = FCPATH . 'gambar/app/' . $artikel['gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $model->delete($id);
        return redirect()->to('/admin')->with('success', 'Data berhasil dihapus!');
    }
}