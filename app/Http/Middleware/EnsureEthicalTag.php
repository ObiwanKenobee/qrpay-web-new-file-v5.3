<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEthicalTag
{
    protected $requiredTags = [
        'origin',
        'impact_type',
        'verification_level'
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ethical_tags')) {
            $tags = $request->get('ethical_tags');
            
            // Ensure tags are provided as array
            if (!is_array($tags)) {
                return response()->json([
                    'error' => 'Ethical tags must be provided as an array',
                ], 422);
            }

            // Validate required tags
            $missingTags = array_diff($this->requiredTags, array_keys($tags));
            if (!empty($missingTags)) {
                return response()->json([
                    'error' => 'Missing required ethical tags',
                    'missing_tags' => $missingTags
                ], 422);
            }

            // Validate tag values
            if (!$this->validateTagValues($tags)) {
                return response()->json([
                    'error' => 'Invalid ethical tag values',
                ], 422);
            }
        }

        return $next($request);
    }

    protected function validateTagValues(array $tags): bool
    {
        $validImpactTypes = ['environmental', 'social', 'community', 'sustainable', 'renewable'];
        $validVerificationLevels = ['self', 'community', 'third-party', 'certified'];

        if (!in_array($tags['impact_type'], $validImpactTypes)) {
            return false;
        }

        if (!in_array($tags['verification_level'], $validVerificationLevels)) {
            return false;
        }

        if (empty($tags['origin'])) {
            return false;
        }

        return true;
    }
}
