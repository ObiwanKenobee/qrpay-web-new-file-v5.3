<?php

namespace App\Services;

class WildResilience
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getDoveDome(): array
    {
        return $this->config['dove_dome'];
    }

    public function getDoveDomeSymbols(): array
    {
        return $this->config['dove_dome_symbol'];
    }

    public function getResilienceMetrics(): array
    {
        return $this->config['resilience_metrics'];
    }

    public function getSystemStates(): array
    {
        return $this->config['system_states'];
    }

    public function getPeaceGardens(): array
    {
        return $this->config['peace_gardens'];
    }

    public function isOperational(): bool
    {
        return $this->config['dove_dome']['status'] === 'operational';
    }

    public function isPeaceGardensActive(): bool
    {
        return $this->config['peace_gardens']['status'] === 'active';
    }

    public function getPeaceGardensCapacity(): int
    {
        return (int) $this->config['peace_gardens']['capacity'];
    }

    public function getPeaceGardensVisitors(): int
    {
        return (int) $this->config['peace_gardens']['current_visitors'];
    }

    public function getTherapy(): array
    {
        return $this->config['therapy'];
    }

    public function getTherapyStats(): array
    {
        return $this->config['therapy']['stats'];
    }

    public function getActiveTherapyPrograms(): array
    {
        return array_filter($this->config['therapy']['active_programs']);
    }

    public function getTherapySchedule(): array
    {
        return array_filter($this->config['therapy']['schedule']);
    }

    public function getGuardianNetwork(): array
    {
        return $this->config['guardian_network'];
    }

    public function getGuardianNetworkStatus(): array
    {
        return $this->config['guardian_network']['network_status'];
    }

    public function getGuardianNetworkResources(): array
    {
        return $this->config['guardian_network']['resources'];
    }

    public function isGuardianNetworkHealthy(): bool
    {
        return $this->config['guardian_network']['node_health'] === 'Healthy';
    }

    public function getGuardianNetworkUtilization(): array
    {
        return [
            'nodes' => [
                'active' => (int) $this->config['guardian_network']['active_nodes'],
                'total' => (int) $this->config['guardian_network']['total_nodes'],
                'percentage' => $this->config['guardian_network']['total_nodes'] > 0 
                    ? round(($this->config['guardian_network']['active_nodes'] / $this->config['guardian_network']['total_nodes']) * 100)
                    : 0
            ],
            'resources' => $this->getGuardianNetworkResources()
        ];
    }

    public function getImpactWallet(): array
    {
        return $this->config['impact_wallet'];
    }

    public function getRecentAid(): array
    {
        return $this->config['impact_wallet']['recent_aid'];
    }

    public function getImpactMetrics(): array
    {
        return $this->config['impact_wallet']['impact_metrics'];
    }

    public function getWalletSettings(): array
    {
        return $this->config['impact_wallet']['settings'];
    }

    public function formatCurrency(int $amount): string
    {
        $currency = $this->config['impact_wallet']['currency'];
        return $currency . ' ' . number_format($amount);
    }

    public function getTotalAidDistributed(): int
    {
        return (int) $this->config['impact_wallet']['impact_metrics']['total_aid_distributed'];
    }

    public function getMetricProgress(string $metric): int
    {
        if (isset($this->config['resilience_metrics'][$metric])) {
            $data = $this->config['resilience_metrics'][$metric];
            return ($data['current'] / $data['target']) * 100;
        }
        return 0;
    }
}