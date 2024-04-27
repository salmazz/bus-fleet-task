<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSeatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => 'required|integer|exists:trips,id',
            'trip_station_from_id' => 'required|integer|exists:trip_stations,id',
            'trip_station_to_id' => 'required|integer|exists:trip_stations,id',
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            'seat_number' => 'required'
        ];
    }
}
