<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function getIndex()
    {
        return view('vi/home', ['title' => 'Home']);
    }
    public function getAbout()
    {
        return view('vi/about', ['title' => 'About']);
    }
    public function getArtikel()
    {
        return view('vi/article', ['title' => 'Artikel']);
    }
    public function getContact()
    {
        return view('vi/contact', ['title' => 'Kontak']);
    }
}