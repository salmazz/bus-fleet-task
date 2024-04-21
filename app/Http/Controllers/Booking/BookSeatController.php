<?php

namespace App\Http\Controllers\Booking;

use App\Dto\Booking\BookSeatDto;
use App\Http\Controllers\Controller;
use App\Services\Booking\BookingServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookSeatController extends Controller
{
    /**
     * @var BookingServiceInterface
     */
    public BookingServiceInterface $bookingService;

    /**
     * BookSeatController constructor.
     *
     * @param BookingServiceInterface $bookingService
     */
    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Book seat for a trip
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $bookSeatsDto = BookSeatDto::fromRequest($request);
            $booking = $this->bookingService->bookSeat($bookSeatsDto);

            return jsonResponse("Booked successfully", ['booking' => $booking],  Response::HTTP_OK);
        } catch (\Exception $e) {
            return jsonResponse($e->getMessage(), ['booking' => []],  Response::HTTP_NOT_FOUND);
        }
    }
}
