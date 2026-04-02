<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex()
    {
        return view('vi/home', ['title' => 'Home']);
    }
}