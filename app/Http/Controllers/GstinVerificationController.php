<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GstinVerificationService;
use Exception;

class GstinVerificationController extends Controller
{
    protected $gstinVerificationService;

    public function __construct(GstinVerificationService $gstinVerificationService)
    {
        $this->gstinVerificationService = $gstinVerificationService;
    }

    public function verify(Request $request)
    {
        $gstin_number = $request->input('gstin_number');
        // dd($gstin_number);

        $request->validate([
            'gstin_number' => 'required|string|size:15',
        ]);

        try {
            $result = $this->gstinVerificationService->verifyGstin($request->gstin_number);
            if (isset($result['data']['address'])) {
                return response()->json([
                    'address' => $result['data']['address'],
                ], 200);
            } else {
                return response()->json(['error' => 'Address not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
