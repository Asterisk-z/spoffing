<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\OrgDomain;
use App\Services\OpenSquat;
use Illuminate\Support\Facades\Request;
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
        $domains = OrgDomain::where('organization_id', $organization->id)->get();
        return Inertia::render('Organization/View', [
            "organization" => $organization,
            "domains" => $domains,
        ]);
    }

    public function search(Request $request)
    {
        OpenSquat::search();
        return back();
    }

}
