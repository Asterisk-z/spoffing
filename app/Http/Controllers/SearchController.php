<?php

namespace App\Http\Controllers;

use App\Services\OpenSquat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'domain' => 'required',
        ]);
        $domain = OpenSquat::find($request->domain);

        return Inertia::render('Search', [
            'domain' => $domain,
        ]);
    }
}
