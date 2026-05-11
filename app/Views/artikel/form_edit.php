<?= $this->include('template/admin_header'); ?>

<div class="form-card">
    <div class="form-card-header">
        <h2><?= $title; ?></h2>
        <span class="badge badge-edit">EDIT</span>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">JUDUL ARTIKEL</label>
            <input type="text" name="judul" value="<?= $artikel['judul']; ?>" id="judul" required>
        </div>

        <div class="form-group">
            <label for="id_kategori">KATEGORI</label>
            <select name="id_kategori" id="id_kategori" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" 
                        <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="isi">ISI ARTIKEL</label>
            <textarea name="isi" id="isi" rows="12"><?= $artikel['isi']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="gambar">GANTI GAMBAR (Opsional)</label>
            <?php if (!empty($artikel['gambar'])): ?>
                <div style="margin-bottom: var(--sp-2);">
                    <img src="<?= base_url('/gambar/app/' . $artikel['gambar']); ?>" 
                         alt="Current Image" style="max-height: 120px; border-radius: var(--r-sm); border: 1px solid var(--c-border);">
                    <p class="form-hint">Gambar saat ini: <?= $artikel['gambar']; ?></p>
                </div>
            <?php endif; ?>
            <input type="file" name="gambar" id="gambar">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">UPDATE ARTIKEL</button>
        </div>
    </form>
</div>

<?= $this->include('template/admin_footer'); ?>