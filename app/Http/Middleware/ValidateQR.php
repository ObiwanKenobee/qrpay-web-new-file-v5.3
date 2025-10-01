<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\QRService;

class ValidateQR
{
    protected $qrService;

    public function __construct(QRService $qrService)
    {
        $this->qrService = $qrService;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($request->has('qr_data')) {
            try {
                // Parse and validate QR data
                $qrData = $this->qrService->parseQRCode($request->get('qr_data'));
                
                // Check if QR code exists and is valid
                if (!$this->qrService->validateQRCode($qrData['identifier'])) {
                    return response()->json([
                        'error' => 'Invalid QR code',
                    ], 422);
                }

                // Add parsed data to request
                $request->merge(['parsed_qr_data' => $qrData]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'QR validation failed',
                    'message' => $e->getMessage()
                ], 422);
            }
        }

        return $next($request);
    }
}
