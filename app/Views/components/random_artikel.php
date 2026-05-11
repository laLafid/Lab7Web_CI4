<ul>
    <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $row): ?>
            <li>
                <a href="<?= base_url('artikel/view/' . $row['slug']); ?>">
                    <?= $row['judul']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Tidak ada artikel pilihan.</li>
    <?php endif; ?>
</ul>