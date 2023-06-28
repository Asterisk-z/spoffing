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
        $organizations = Organization::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->with('domains')->paginate(10);
        return Inertia::render('Organization/Index', [
            "organizations" => $organizations,
        ]);
    }

    public function store(OrganizationRequest $request)
    {
        $data = $request->validated();

        $organization = Organization::where('name', $data['name'])->where('user_id', auth()->user()->id)->exists();
        if (!$organization) {
            $org = Organization::create([
                'name' => $data['name'],
                'user_id' => auth()->user()->id,
                'last_search' => now(),
            ]);
            OpenSquat::search($data['name'], $org->id);
            // FindSimiliarDomain::dispatch($data['name'], auth()->user()->id);
            return Inertia::location(route('organization'));
        }
        return back();

    }

    public function view()
    {
        $organization = Organization::where('user_id', auth()->user()->id)->where('name', request('domain'))->where('id', request('id'))->first();
        $domains = OrgDomain::where('organization_id', $organization->id)->paginate(10);
        return Inertia::render('Organization/View', [
            "organization" => $organization,
            "domains" => $domains,
            "all" => true,
        ]);
    }

    public function view_latest()
    {
        $organization = Organization::where('user_id', auth()->user()->id)->where('name', request('domain'))->where('id', request('id'))->first();
        $domains = OrgDomain::where('organization_id', $organization->id)->whereBetween('created_at', [now()->subHours(20), now()])->paginate(10);
        return Inertia::render('Organization/View', [
            "organization" => $organization,
            "domains" => $domains,
            'all' => false,
        ]);
    }

    public function search(Request $request)
    {
        OpenSquat::search(request('name'), request('organization_id'));

        // (new AlertOnNewDomain())->toMail(auth()->user()->email);
        // auth()->user->notify((new AlertOnNewDomain())->delay(now()->addSeconds(30)));
        return back();
    }

    public function cancel()
    {
        $organization = Organization::where('id', request('org_id'))->first();
        if ($organization) {
            $organization->status = "LOCKED";
            $organization->save();
        }
    }

    public function activate()
    {
        $organization = Organization::where('id', request('org_id'))->first();
        if ($organization) {
            $organization->status = "ACTIVE";
            $organization->save();
        }
    }

}
