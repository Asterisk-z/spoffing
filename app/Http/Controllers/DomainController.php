<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DomainController extends Controller
{
    public function index()
    {
        return Inertia::render('Domains');
    }
}