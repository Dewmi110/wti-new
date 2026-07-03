<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\EnquiryReceived;

class EnquiryController extends Controller
{
    public function submit(Request $request)
    {
        Log::info('Enquiry request received', ['ip' => $request->ip(), 'payload' => $request->all()]);

        $data = $request->validate([
            'service_type' => 'required|string',
            'travel_date'  => 'required|date',
            'destination'  => 'required|string',
            'num_people'   => 'required|integer|min:1',
            'full_name'    => 'required|string',
            'city'         => 'required|string',
            'email'        => 'required|email',
            'phone'        => 'required|string',
            'whatsapp'     => 'nullable|string',
            'comments'     => 'nullable|string',
        ]);

        $emailMap = [
            'Visit to Sri Lanka' => 'inbound@wti.lk',
            'Outbound Tours'     => 'outboundtours@wti.lk',
            'MICE Tours'         => 'hello@wti.lk',
            'Corporate Travel'   => 'hello@wti.lk',
            'Air Tickets'        => 'ticketing@wti.lk',
            'Visa Services'      => 'visa@wti.lk',
            'Ancillaries'        => 'hello@wti.lk',
        ];

        $service = $data['service_type'];
        $toEmail = $emailMap[$service] ?? null;

        if (! $toEmail) {
            return response()->json(['message' => 'No recipient configured for selected service'], 422);
        }

        // Use a sensible CC/BCC - cc to operations@wti.com, bcc dewmi.t@fitscargo.com
        try {
            Mail::to($toEmail)
                ->cc('operations@wti.com')
                ->bcc('dewmi.t@fitscargo.com')
                ->send(new EnquiryReceived($data));
        } catch (\Throwable $e) {
            Log::error('Enquiry mail send failed', ['error' => $e->getMessage(), 'data' => $data]);
            $resp = ['message' => 'Failed to send enquiry. Please try again later.'];
            if (config('app.debug')) {
                $resp['error'] = $e->getMessage();
            }
            return response()->json($resp, 500);
        }

        return response()->json(['message' => 'Enquiry sent']);
    }
}
