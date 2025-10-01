<?php

namespace App\Services;

class EmergencyServices
{
    protected array $dataConfig;
    protected array $smsConfig;
    protected array $callsConfig;

    public function __construct(array $dataConfig, array $smsConfig, array $callsConfig)
    {
        $this->dataConfig = $dataConfig;
        $this->smsConfig = $smsConfig;
        $this->callsConfig = $callsConfig;
    }

    public function getRemainingData(): string
    {
        return $this->dataConfig['amount'];
    }

    public function getRemainingMessages(): int
    {
        return (int) $this->smsConfig['amount'];
    }

    public function getRemainingCallMinutes(): int
    {
        return (int) $this->callsConfig['minutes'];
    }

    public function getEmergencyNumbers(): array
    {
        return $this->smsConfig['priority_numbers'];
    }

    public function getDailyLimits(): array
    {
        return [
            'data' => $this->dataConfig['daily_limit'],
            'sms' => $this->smsConfig['daily_limit'],
            'calls' => $this->callsConfig['daily_limit'],
        ];
    }
}