<?php

namespace App\Traits;

trait Verifiable
{
    public function isVerified(): bool
    {
        return $this->verificationRecord?->verification_status === 'verified';
    }

    public function getVerificationData(): ?array
    {
        return $this->verificationRecord?->verification_data;
    }

    public function getVerifierType(): ?string
    {
        return $this->verificationRecord?->verifier_type;
    }

    public function getVerifiedAt(): ?\Carbon\Carbon
    {
        return $this->verificationRecord?->verified_at;
    }
}