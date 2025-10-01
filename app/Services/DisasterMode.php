<?php

namespace App\Services;

class DisasterMode
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function isActive(): bool
    {
        return (bool) $this->config['active'];
    }

    public function getEmergencyData(): array
    {
        return $this->config['emergency_data'];
    }

    public function getEmergencySms(): array
    {
        return $this->config['emergency_sms'];
    }

    public function getEmergencyCalls(): array
    {
        return $this->config['emergency_calls'];
    }

    public function getMeshNetwork(): array
    {
        return $this->config['mesh_network'];
    }

    public function getNotificationSettings(): array
    {
        return $this->config['notifications'];
    }

    public function getResources(): array
    {
        return $this->config['resources'];
    }
}