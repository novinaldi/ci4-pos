<?php

namespace App\Controllers;

class Layout extends BaseController
{
    public function index()
    {
        return view('layout/home');
    }
}