<?= $this->include('template/admin_header'); ?>
<div class="form-card">
  <div class="form-card-header">
    <span class="badge badge-edit">Edit</span>
    <h2><?= $title; ?></h2>
  </div>

  <div class="edit-indicator">
    <div class="dot"></div>
    Mengedit: <strong><?= $data['judul']; ?></strong>
  </div>

  <form action="" method="post">
    <div class="form-group">
      <label for="judul">Judul Artikel</label>
      <input type="text" id="judul" name="judul" value="<?= $data['judul']; ?>">
    </div>

    <div class="form-group">
      <label for="isi">Isi Artikel</label>
      <textarea id="isi" name="isi" rows="10"><?= $data['isi']; ?></textarea>
    </div>

    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori">
        <option value="umum"      <?= $data['kategori']=='umum'      ? 'selected':'' ?>>Umum</option>
        <option value="teknologi" <?= $data['kategori']=='teknologi' ? 'selected':'' ?>>Teknologi</option>
        <option value="berita"    <?= $data['kategori']=='berita'    ? 'selected':'' ?>>Berita</option>
      </select>
    </div>

    <div class="form-actions">
    <a href="<?= base_url('/artikel'); ?>" class="btn btn-ghost">Batal</a>
    <input type="submit" value="Simpan Artikel" class="btn btn-large">
</div>
  </form>
</div>
<?= $this->include('template/admin_footer'); ?>