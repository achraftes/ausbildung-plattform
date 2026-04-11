<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AusbildungController extends Controller
{
    public function index()
    {
        return view('pages.ausbildung'); // nom du fichier blade
    }
}