<?php

namespace App\Http\Controllers\Booking;

use App\Dto\Booking\AvailableSeatDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableRequest;
use App\Services\Booking\BookingServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAvailableSeatsController extends Controller
{
    /**
     * @var BookingServiceInterface
     */
    public BookingServiceInterface $bookingService;

    /**
     * GetAvailableSeatsController constructor.
     *
     * @param BookingServiceInterface $bookingService
     */
    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Get available seats for a trip
     *
     * @param AvailableRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AvailableRequest $request)
    {
        try {
            $availableSeatsDto = AvailableSeatDto::fromRequest($request);
            $availableSeats = $this->bookingService->getAvailableSeats($availableSeatsDto);

            return jsonResponse("Available seats retrieved successfully", ['available_seats' => $availableSeats],  Response::HTTP_OK);

        } catch (\Exception $e) {
            return jsonResponse($e->getMessage(), ['available_seats' => []],  Response::HTTP_NOT_FOUND);
        }
    }
}
