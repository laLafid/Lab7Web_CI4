<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><title><?=$title; ?></title><link rel="stylesheet" href="<?=base_url('/style.css');?>"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></head>
<body><div id="container"><header><h1>Layout Sederhana</h1></header>
        <nav>
            <?php $current_page = uri_string(); ?>
            <a href="<?= base_url('admin'); ?>" class="<?= ($current_page == 'admin') ? 'active' : ''; ?>">Home</a>
            <a href="<?=base_url('admin/add'); ?>" class="<?=($current_page=='admin/add') ? 'active' : ''; ?>">Tambah Artikel</a>
        </nav>
        <section id="wrapper">
            <section id="main">