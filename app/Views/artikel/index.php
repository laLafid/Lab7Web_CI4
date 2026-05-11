<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div id="article-manager">
    <div class="badge-list">
        <a href="<?= base_url('artikel') ?>" 
           class="badge badge-edit <?= $kategori_id == '' ? 'active' : '' ?>">Semua Kategori</a>
        <?php foreach ($kategori as $k): ?>
            <a href="<?= base_url('artikel?kategori_id=' . $k['id_kategori']) ?>" 
               class="badge badge-edit <?= $kategori_id == $k['id_kategori'] ? 'active' : '' ?>">
                <?= $k['nama_kategori'] ?>
            </a>
        <?php endforeach; ?>
        <span class="loader-inline">Memuat...</span>
    </div>

    <div id="article-posts">
        <?php if ($artikel): ?>
            <?php foreach ($artikel as $row): ?>
                <article class="entry fade-in-up">
                    <?php if(!empty($row['gambar'])): ?>
                        <?php if (pathinfo($row['gambar'], PATHINFO_EXTENSION) === 'mp4'): ?>
                            <video src="<?= base_url('gambar/app/' . $row['gambar']); ?>" 
                                   autoplay loop muted playsinline class="media-moving"></video>
                        <?php else: ?>
                            <img src="<?= base_url('gambar/app/' . $row['gambar']); ?>" 
                                 alt="<?= $row['judul']; ?>" class="media-moving">
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="entry-content">
                        <span class="badge badge-edit"><?= $row['nama_kategori'] ?></span>
                        <h2><a href="<?= base_url('/artikel/view/' . $row['slug']); ?>"><?= $row['judul']; ?></a></h2>
                        
                        <p class="text-muted text-sm" style="margin-bottom: var(--sp-3);">
                            Diposting pada <?= date('d M Y', strtotime($row['created_at'])) ?>
                        </p>

                        <p class="excerpt"><?= substr(strip_tags($row['isi'] ?? ''), 0, 220); ?>...</p>
                        
                        <a href="<?= base_url('/artikel/view/' . $row['slug']); ?>" class="btn btn-default">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article class="entry">
                <h2>Belum ada artikel yang tersedia.</h2>
            </article>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    // Fungsi utama untuk memuat konten
    function loadArticles(url) {
        const $container = $('#article-manager');
        const $loader = $('.loader-inline');

        // Visual feedback
        $container.addClass('ajax-loading');
        $loader.fadeIn();

        // Ambil konten via AJAX
        $.get(url, function(data) {
            // Ambil hanya bagian #article-manager dari halaman yang baru diambil
            const newHtml = $(data).find('#article-manager').html();
            
            // Ganti konten lama dengan yang baru
            $container.html(newHtml);
            
            // Reset state visual
            $container.removeClass('ajax-loading');
            
            // Update URL di address bar tanpa reload
            window.history.pushState({ path: url }, '', url);
        }).fail(function() {
            alert('Gagal memuat artikel.');
            $container.removeClass('ajax-loading');
        });
    }

    // Tangkap klik pada badge kategori (Delegasi event)
    $(document).on('click', '.badge-list a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        loadArticles(url);
    });

    // Tangani tombol BACK/FORWARD di browser
    window.onpopstate = function() {
        loadArticles(location.href);
    };
});
</script>

<?= $this->endSection() ?>