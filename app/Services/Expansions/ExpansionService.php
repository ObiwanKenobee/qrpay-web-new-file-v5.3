<?php

namespace App\Services\Expansions;

use App\Models\ExpansionProfile;

class ExpansionService
{
    public function createProfile(int $userId, string $type, array $settings = [], array $features = []): ExpansionProfile
    {
        return ExpansionProfile::create([
            'user_id' => $userId,
            'type' => $type,
            'settings' => $settings,
            'features' => $features,
            'status' => 'active'
        ]);
    }

    public function updateSettings(ExpansionProfile $profile, array $settings): ExpansionProfile
    {
        $profile->settings = array_merge($profile->settings ?? [], $settings);
        $profile->save();
        return $profile;
    }

    public function updateFeatures(ExpansionProfile $profile, array $features): ExpansionProfile
    {
        $profile->features = array_merge($profile->features ?? [], $features);
        $profile->save();
        return $profile;
    }

    public function toggleStatus(ExpansionProfile $profile): ExpansionProfile
    {
        $profile->status = $profile->status === 'active' ? 'inactive' : 'active';
        $profile->save();
        return $profile;
    }
}