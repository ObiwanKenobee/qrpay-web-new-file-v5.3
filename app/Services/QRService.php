<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRService
{
    public function generateForTransaction(Transaction $transaction): string
    {
        // Generate unique identifier for the QR code
        $identifier = Str::random(32);
        
        // Create QR data payload
        $payload = [
            'id' => $transaction->id,
            'amount' => $transaction->amount,
            'currency' => $transaction->currency,
            'sender' => $transaction->sender_wallet_id,
            'receiver' => $transaction->receiver_wallet_id,
            'timestamp' => $transaction->created_at->timestamp,
            'identifier' => $identifier
        ];

        // Generate QR code
        $qrCode = QrCode::format('png')
            ->size(300)
            ->errorCorrection('H')
            ->generate(json_encode($payload));

        // Save QR code to public directory
        $filename = "qr/{$identifier}.png";
        \Storage::disk('public')->put($filename, $qrCode);

        return $filename;
    }

    public function parseQRCode(string $qrData): array
    {
        $data = json_decode($qrData, true);

        if (!$data) {
            throw new \Exception('Invalid QR code data');
        }

        // Validate required fields
        $requiredFields = ['id', 'amount', 'currency', 'sender', 'receiver', 'timestamp', 'identifier'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new \Exception("Missing required field: {$field}");
            }
        }

        return $data;
    }

    public function validateQRCode(string $identifier): bool
    {
        // Check if QR code exists
        if (!\Storage::disk('public')->exists("qr/{$identifier}.png")) {
            return false;
        }

        // Check if transaction exists and is valid
        $transaction = Transaction::where('qr_code', "qr/{$identifier}.png")->first();
        if (!$transaction) {
            return false;
        }

        return true;
    }
}