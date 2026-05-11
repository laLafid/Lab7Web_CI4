<?= $this->include('template/admin_header'); ?>

<div class="admin-header">
    <h2>Management Artikel</h2>
    <a href="<?= base_url('admin/add'); ?>" class="btn btn-default">+ Tambah Artikel</a>
</div>

<form method="get" class="admin-toolbar">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari judul artikel..." 
           style="flex: 1;"
           oninput="clearTimeout(window._t); window._t = setTimeout(() => this.form.submit(), 800)">

    <select name="kategori_id" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                <?= $k['nama_kategori']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-ghost">Cari</button>
</form>

<div class="table-wrapper">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th style="width: 80px;">Media</th>
                <th>Judul & Konten</th>
                <th>Kategori</th>
                <th>Status</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($artikel) > 0): ?>
                <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td>
                            <?php if(!empty($row['gambar'])): ?>
                                <?php if (pathinfo($row['gambar'], PATHINFO_EXTENSION) === 'mp4'): ?>
                                    <video src="<?= base_url('gambar/app/' . $row['gambar']); ?>" 
                                           style="width: 60px; height: 45px; object-fit: cover; border-radius: var(--r-sm);" 
                                           muted playsinline onmouseover="this.play()" onmouseout="this.pause()"></video>
                                <?php else: ?>
                                    <img src="<?= base_url('gambar/app/' . $row['gambar']); ?>" 
                                         style="width: 60px; height: 45px; object-fit: cover; border-radius: var(--r-sm);">
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="width: 60px; height: 45px; background: var(--c-ground); border-radius: var(--r-sm);"></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="title-cell"><?= $row['judul']; ?></span>
                            <span class="excerpt-cell"><?= substr(strip_tags($row['isi']), 0, 70); ?>...</span>
                        </td>
                        <td><span class="badge badge-edit"><?= $row['nama_kategori']; ?></span></td>
                        <td>
                            <span class="status-pill <?= $row['status'] == 1 ? 'status-published' : 'status-draft'; ?>">
                                <?= $row['status'] == 1 ? 'Published' : 'Draft'; ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div class="action-cell">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('/admin/edit/' . $row['id']); ?>">EDIT</a>
                                <a class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin ingin menghapus artikel ini?')" 
                                   href="<?= base_url('/admin/delete/' . $row['id']); ?>">DELETE</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted">Tidak ada artikel yang ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?= $pager->only(['q', 'kategori_id'])->links(); ?>
</div>

<?= $this->include('template/admin_footer'); ?>
