<?php
use App\Http\Controllers\ServiceRequestController;

// GET: Fetch all service requests
Route::get('/service-requests', [ServiceRequestController::class, 'index']);

// POST: Create a new service request
Route::post('/service-requests', [ServiceRequestController::class, 'store']);

// GET: Fetch a service request by ID
Route::get('/service-requests/id/{id}', [ServiceRequestController::class, 'showById']);

// GET: Fetch a service request by booking_reference
Route::get('/service-requests/booking_reference/{booking_reference}', [ServiceRequestController::class, 'showByBookingReference']);

// GET: Fetch a service request by tradie_id
Route::get('/service-requests/tradie_id/{tradie_id}', [ServiceRequestController::class, 'showByTradieId']);

// PUT: Update a service request by ID
Route::put('/service-requests/id/{id}', [ServiceRequestController::class, 'updateById']);

// PUT: Update a service request by booking_reference
Route::put('/service-requests/booking_reference/{booking_reference}', [ServiceRequestController::class, 'updateByBookingReference']);

// PUT: Update a service request by tradie_id
Route::put('/service-requests/tradie_id/{tradie_id}', [ServiceRequestController::class, 'updateByTradieId']);

// DELETE: Remove a service request by ID
Route::delete('/service-requests/id/{id}', [ServiceRequestController::class, 'destroyById']);

// DELETE: Remove a service request by booking_reference
Route::delete('/service-requests/booking_reference/{booking_reference}', [ServiceRequestController::class, 'destroyByBookingReference']);

// DELETE: Remove a service request by tradie_id
Route::delete('/service-requests/tradie_id/{tradie_id}', [ServiceRequestController::class, 'destroyByTradieId']);

