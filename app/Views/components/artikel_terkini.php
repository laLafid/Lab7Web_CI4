<h3 class="title">Artikel Terkini: <?= ucfirst($kategori) ?></h3>
<ul>
    <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $row): ?>
            <li>
                <a href="<?= base_url('artikel/view/' . $row['slug']) ?>">
                    <?= $row['judul'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Tidak ada artikel untuk kategori ini.</li>
    <?php endif; ?>
</ul>