<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</head>

<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>

        <?php 
        $current = strtolower(uri_string()); 
        ?>
        <nav>
            <a href="<?=base_url(); ?>" class="<?=in_array($current, ['', '/']) ? 'active' : ''; ?>">HOME</a>
            <a href="<?=base_url('artikel'); ?>" class="<?=strpos($current, 'artikel')===0 ? 'active' : ''; ?>">ARTIKEL</a>
            <a href="<?=base_url('page/about'); ?>" class="<?=$current==='page/about' ? 'active' : ''; ?>">ABOUT</a>
            <a href="<?=base_url('page/contact'); ?>" class="<?=$current==='page/contact' ? 'active' : ''; ?>">KONTAK</a>
            <a href="<?=base_url('user/login'); ?>" class="<?=strpos($current, 'user/login')===0 ? 'active' : ''; ?>">LOGIN</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <?= $this->renderSection('content') ?>
            </section>

            <aside id="sidebar">
                <div class="widget-box">
                    <?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 'random', 'limit' => 3]) ?>
                </div>

                <div class="widget-box">
                    <h3 class="title">Artikel Pilihan</h3>
                    <?= view_cell('App\\Cells\\RandomArtikel::render', ['limit' => 2]) ?>
                </div>
                <div class="widget-box">
                    <h3 class="title">INFO</h3>
                    <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu. Proin in leo fringilla.</p>
                </div>
            </aside>
        </section>
        <footer>
            <p>&copy; <?= date('Y') ?> - Lafid | All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>