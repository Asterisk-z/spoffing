<?php

namespace App\Http\Controllers;

use App\Models\DomainDetail;
use App\Models\Organization;
use App\Models\OrgDomain;
use App\Services\PulseDive;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Domain/View', [
            'organization' => Organization::where('id', request('org_id'))->first(),
            'domain' => OrgDomain::where('id', request('id'))->first(),
            'details' => DomainDetail::where('domain_id', request('id'))->first(),
        ]);
    }

    public function detail(Request $request)
    {
        $data = DomainDetail::where('domain_id', request('domain_id'))->first();

        if (!$data) {
            $response = PulseDive::search(request('domain'), request('domain_id'));

            if ($response['status'] == 'done') {
                $data = $response['data'];

                DomainDetail::create([
                    'domain_id' => request('domain_id'),
                    'qid' => $data['qid'],
                    // 'indicator' => $data['indicator'],
                    'risk' => $data['risk'],
                    'risk_recommended' => $data['risk_recommended'],
                    'manualrisk' => $data['manualrisk'],
                    'retired' => $data['retired'],
                    'stamp_added' => $data['stamp_added'],
                    'stamp_updated' => $data['stamp_updated'],
                    'stamp_seen' => $data['stamp_seen'],
                    'stamp_probed' => $data['stamp_probed'],
                    'stamp_retired' => $data['stamp_retired'],
                    'recent' => $data['recent'],
                    'submissions' => $data['submissions'],
                    'umbrella_rank' => $data['umbrella_rank'],
                    'umbrella_domain' => $data['umbrella_domain'],
                    'riskfactors' => json_encode($data['riskfactors']),
                    'redirects' => json_encode($data['redirects']),
                    'attributes' => json_encode($data['attributes']),
                    'properties' => json_encode($data['properties']),
                    'links' => json_encode($data['links']),
                ]);

                // return response()->json(['data' => $details]);
            }
        }

        // return response()->json(['data' => $data]);

    }
}
