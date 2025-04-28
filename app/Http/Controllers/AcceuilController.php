<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceuilController extends Controller
{
    public function Acceuil()
    {
        return view('home.acceuil');
    }

    public function Groupement()
    {
        return view('home.groupement');
    }

    public function Contact()
    {
        return view('home.contact');
    }

    public function Prestation()
    {
        return view('home.prestation');
    }
}
