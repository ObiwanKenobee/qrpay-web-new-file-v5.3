<?php

namespace App\Traits;

trait HasEthicalImpact
{
    public function calculateTotalImpact(): float
    {
        return $this->ethicalImpactMetrics()
            ->where('metric_type', 'environmental')
            ->sum('value');
    }

    public function getImpactByType(string $type): float
    {
        return $this->ethicalImpactMetrics()
            ->where('metric_type', $type)
            ->sum('value');
    }

    public function hasPositiveImpact(): bool
    {
        return $this->calculateTotalImpact() > 0;
    }
}