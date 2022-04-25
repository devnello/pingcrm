<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PathtofreedomController extends Controller
{
    public function index()
    {
        return Inertia::render('Capitulo/Index');
    }
}
