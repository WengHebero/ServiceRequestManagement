<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceRequestController extends Controller
{
    // GET: Fetch all service requests
    public function index()
    {
        return response()->json(ServiceRequest::all(), 200);
    }

    // POST: Create a new service request
    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|string',
            'tradie_id' => 'required|string',
            'service_id' => 'required|string',
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_session' => 'required|boolean',
        ]);

        // Generate unique booking reference
        $bookingReference = ServiceRequest::generateBookingReference();

        // Create new service request
        $serviceRequest = ServiceRequest::create([
            'booking_reference' => $bookingReference,
            'resident_id' => $request->resident_id,
            'tradie_id' => $request->tradie_id,
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'booking_session' => $request->booking_session,
            'status' => 'Confirmed',
        ]);

        return response()->json($serviceRequest, 201);
    }

    public function showById($id)
    {
        $serviceRequest = ServiceRequest::find($id);
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }
        return response()->json($serviceRequest, 200);
    }

    public function showByBookingReference($booking_reference)
    {
        $serviceRequest = ServiceRequest::where('booking_reference', $booking_reference)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }
        return response()->json($serviceRequest, 200);
    }

    public function showByTradieId($tradie_id)
    {
        $serviceRequest = ServiceRequest::where('tradie_id', $tradie_id)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }
        return response()->json($serviceRequest, 200);
    }

    // PUT: Update an existing service request by ID
    public function updateById(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::find($id);
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $request->validate([
            'status' => 'in:Confirmed,Completed,Cancelled',
        ]);

        $serviceRequest->update($request->all());
        return response()->json($serviceRequest, 200);
    }

    // PUT: Update an existing service request by booking_reference
    public function updateByBookingReference(Request $request, $booking_reference)
    {
        $serviceRequest = ServiceRequest::where('booking_reference', $booking_reference)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $request->validate([
            'status' => 'in:Confirmed,Completed,Cancelled',
        ]);

        $serviceRequest->update($request->all());
        return response()->json($serviceRequest, 200);
    }

    // PUT: Update an existing service request by tradie_id
    public function updateByTradieId(Request $request, $tradie_id)
    {
        $serviceRequest = ServiceRequest::where('tradie_id', $tradie_id)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $request->validate([
            'status' => 'in:Confirmed,Completed,Cancelled',
        ]);

        $serviceRequest->update($request->all());
        return response()->json($serviceRequest, 200);
    }

    // DELETE: Remove a service request by ID
    public function destroyById($id)
    {
        $serviceRequest = ServiceRequest::find($id);
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $serviceRequest->delete();
        return response()->json(['message' => 'Service Request deleted successfully'], 200);
    }

    // DELETE: Remove a service request by booking_reference
    public function destroyByBookingReference($booking_reference)
    {
        $serviceRequest = ServiceRequest::where('booking_reference', $booking_reference)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $serviceRequest->delete();
        return response()->json(['message' => 'Service Request deleted successfully'], 200);
    }

    // DELETE: Remove a service request by tradie_id
    public function destroyByTradieId($tradie_id)
    {
        $serviceRequest = ServiceRequest::where('tradie_id', $tradie_id)->first();
        if (!$serviceRequest) {
            return response()->json(['message' => 'Service Request not found'], 404);
        }

        $serviceRequest->delete();
        return response()->json(['message' => 'Service Request deleted successfully'], 200);
    }
}
