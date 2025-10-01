<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImpactWallet;
use App\Models\CommunityBond;
use App\Models\GreenMpesaToken;
use App\Models\EducationBundle;
use App\Models\WildResilienceNode;

class HeaderDataController extends Controller
{
    public function getHeaderData(Request $request)
    {
        $userId = auth()->id();
        $impactWallet = ImpactWallet::where('user_id', $userId)->first();
        $communityBond = CommunityBond::where('user_id', $userId)->first();
        $greenMpesa = GreenMpesaToken::where('user_id', $userId)->first();
        $educationBundles = EducationBundle::all();
        $wildResilience = WildResilienceNode::first();

        return response()->json([
            'impactWallet' => $impactWallet,
            'communityBond' => $communityBond,
            'greenMpesa' => $greenMpesa,
            'educationBundles' => $educationBundles,
            'wildResilience' => $wildResilience,
        ]);
    }
}
