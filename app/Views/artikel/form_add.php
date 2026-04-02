<?= $this->include('template/admin_header'); ?>
<div class="form-card">
  <div class="form-card-header">
    <span class="badge badge-add">Tambah</span>
    <h2><?= $title; ?></h2>
  </div>

  <form action="" method="post">
    <div class="form-group">
      <label for="judul">Judul Artikel</label>
      <input type="text" id="judul" name="judul" placeholder="Masukkan judul artikel...">
    </div>

    <div class="form-group">
      <label for="isi">Isi Artikel</label>
      <textarea id="isi" name="isi" rows="10" placeholder="Tulis isi artikel di sini..."></textarea>
    </div>

    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori">
        <option value="">— Pilih kategori —</option>
        <option value="umum">Umum</option>
        <option value="teknologi">Teknologi</option>
        <option value="berita">Berita</option>
      </select>
    </div>

    <div class="form-actions">
    <a href="<?= base_url('/artikel'); ?>" class="btn btn-ghost">Batal</a>
    <input type="submit" value="Simpan Artikel" class="btn btn-large">
</div>
  </form>
</div>

<?= $this->include('template/admin_footer'); ?>