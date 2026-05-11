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
            <a href="<?= base_url('admin'); ?>" class="<?= ($current_page == 'admin') ? 'active' : ''; ?>">Home</a>
            <a href="<?=base_url('ajax'); ?>" class="<?=($current_page=='ajax') ? 'active' : ''; ?>">AJAX</a>
        </nav>
        <section id="wrapper">
            <section id="main">