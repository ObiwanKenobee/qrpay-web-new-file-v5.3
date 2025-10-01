<?php

namespace App\Services;

class MeshNetwork
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function isEnabled(): bool
    {
        return (bool) $this->config['enabled'];
    }

    public function getConnectedNodes(): int
    {
        return (int) $this->config['connected_nodes'];
    }

    public function getMaxNodes(): int
    {
        return (int) $this->config['max_nodes'];
    }

    public function getSignalStrength(): string
    {
        return $this->config['signal_strength'];
    }

    public function getBroadcastInterval(): int
    {
        return (int) $this->config['broadcast_interval'];
    }
}