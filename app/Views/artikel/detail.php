<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<article class="entry single">
    <h2><?= $artikel['judul']; ?></h2>
    <div class="text-center" style="margin-bottom: var(--sp-6);">
        <span class="badge badge-edit"><?= $artikel['nama_kategori']; ?></span>
    </div>
    
    
    <?php if(!empty($artikel['gambar'])): ?>
        <?php if (pathinfo($artikel['gambar'], PATHINFO_EXTENSION) === 'mp4'): ?>
            <video src="<?= base_url('/gambar/app/' . $artikel['gambar']); ?>" 
                   autoplay loop muted playsinline></video>
        <?php else: ?>
            <img src="<?= base_url('/gambar/app/' . $artikel['gambar']); ?>" 
                 alt="<?= $artikel['judul']; ?>">
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="article-content">
        <?= $artikel['isi']; ?>
    </div>
</article>

<div id="disqus_thread"></div>
<script>
    (function () {
        var d = document, s = d.createElement('script');
        s.src = 'https://0nechin.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>

<?= $this->endSection() ?>