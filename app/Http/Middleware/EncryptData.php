<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptData
{
    protected $sensitiveFields = [
        'wallet_id',
        'transaction_data',
        'personal_info',
        'verification_data'
    ];

    public function handle(Request $request, Closure $next)
    {
        // Encrypt sensitive data before processing
        foreach ($this->sensitiveFields as $field) {
            if ($request->has($field)) {
                $data = $request->get($field);
                if (is_array($data)) {
                    $request->merge([
                        $field => $this->encryptArray($data)
                    ]);
                } else {
                    $request->merge([
                        $field => Crypt::encryptString($data)
                    ]);
                }
            }
        }

        $response = $next($request);

        // Decrypt data in response
        if ($response->getContent()) {
            $content = json_decode($response->getContent(), true);
            if ($content && is_array($content)) {
                $content = $this->decryptResponseData($content);
                $response->setContent(json_encode($content));
            }
        }

        return $response;
    }

    protected function encryptArray(array $data): array
    {
        $encrypted = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $encrypted[$key] = $this->encryptArray($value);
            } else {
                $encrypted[$key] = Crypt::encryptString((string) $value);
            }
        }
        return $encrypted;
    }

    protected function decryptResponseData(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->decryptResponseData($value);
            } elseif ($this->isEncrypted($value)) {
                try {
                    $data[$key] = Crypt::decryptString($value);
                } catch (\Exception $e) {
                    // If decryption fails, leave the value as is
                    continue;
                }
            }
        }
        return $data;
    }

    protected function isEncrypted($value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        try {
            Crypt::decryptString($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
