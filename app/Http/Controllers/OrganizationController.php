<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Services\OpenSquat;
use Illuminate\Http\Client\Request;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    public function index()
    {
        return Inertia::render('Organization/Index', [
            "organizations" => Organization::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function store(OrganizationRequest $request)
    {
        $data = $request->validated();

        Organization::create([
            'name' => $data['name'],
            'user_id' => auth()->user()->id,
        ]);

        return Inertia::location(route('organization'));
    }

    public function view()
    {
        $organization = Organization::where('user_id', auth()->user()->id)->where('name', request('domain'))->where('id', request('id'))->first();
        return Inertia::render('Organization/View', [
            "organization" => $organization,
        ]);
    }

    public function search()
    {
        OpenSquat::createfile();
        OpenSquat::search();
    }

}
