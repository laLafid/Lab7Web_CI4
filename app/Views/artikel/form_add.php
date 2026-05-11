<?= $this->include('template/admin_header'); ?>

<div class="form-card">
    <div class="form-card-header">
        <h2><?= $title; ?></h2>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">JUDUL ARTIKEL</label>
            <input type="text" name="judul" id="judul" required>
        </div>

        <div class="form-group">
            <label for="id_kategori">KATEGORI</label>
            <select name="id_kategori" id="id_kategori" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="isi">ISI ARTIKEL</label>
            <textarea name="isi" id="isi" rows="12"></textarea>
        </div>

        <div class="form-group">
            <label for="gambar">GAMBAR</label>
            <input type="file" name="gambar" id="gambar">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">PUBLISH ARTIKEL</button>
        </div>
    </form>
</div>

<?= $this->include('template/admin_footer'); ?>