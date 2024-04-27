<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailableRequest extends FormRequest
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
            'trip_station_from_id' => 'required|integer|exists:trip_stations,id',
            'trip_station_to_id' => 'required|integer|exists:trip_stations,id',
            'date' => 'required|date',
            'trip_id' => 'sometimes|integer|exists:trips,id'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'trip_station_from_id.required' => 'The origin station is required.',
            'trip_station_from_id.integer' => 'The origin station ID must be an integer.',
            'trip_station_from_id.exists' => 'The selected origin station is invalid.',
            'trip_station_to_id.required' => 'The destination station is required.',
            'trip_station_to_id.integer' => 'The destination station ID must be an integer.',
            'trip_station_to_id.exists' => 'The selected destination station is invalid.',
            'date.required' => 'The date is required.',
            'date.date' => 'The date must be a valid date.',
            'trip_id.integer' => 'The trip ID must be an integer.',
            'trip_id.exists' => 'The selected trip is invalid.'
        ];
    }
}
