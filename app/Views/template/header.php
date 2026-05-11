<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>
</head>

<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <?php $current_page = uri_string(); ?>
            <a href="<?=base_url('/');              ?>" class="<?=($current_page=='/')              ? 'active' : ''; ?>">Home</a>
            <a href="<?=base_url('artikel');        ?>" class="<?=($current_page=='page/artikel')   ? 'active' : ''; ?>">Artikel</a>
            <a href="<?=base_url('page/about');     ?>" class="<?=($current_page=='page/about')     ? 'active' : ''; ?>">About</a>
            <a href="<?=base_url('page/contact');   ?>" class="<?=($current_page=='page/contact')   ? 'active' : ''; ?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">