<?php
namespace App\Controllers;
class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title' => 'About'
        ]);
    }
    public function contact()
    {
        return view('contact', [
            'title' => 'Kontak',
            'content' => 'Ini adalah halaman kontak yang akan mengarahkan kalian ke pihak yang bertanggungjaWab atas ini page.'
        ]);
    }
    public function artikel()
    {
        return view('article', [
            'title' => 'Artikel',
            'content' => 'biasanya diisi dengan artikel
            
            
            
            artikel 1
            
            
            
            


            artikel 3
            .'
        ]);
    }
}