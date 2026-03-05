<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">

</head>

<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <?php $current_page = uri_string(); ?>

            <a href="<?= base_url('/'); ?>" class="<?= ($current_page == '') ? 'active' : ''; ?>">Home</a>
            <a href="<?=base_url('article'); ?>" class="<?=($current_page=='article') ? 'active' : ''; ?>">Artikel</a>
            <a href="<?= base_url('about'); ?>" class="<?= ($current_page == 'about') ? 'active' : ''; ?>">About</a>
            <a href="<?=base_url('contact'); ?>" class="<?=($current_page=='contact') ? 'active' : ''; ?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">