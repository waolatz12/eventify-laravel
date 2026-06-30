<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\EventStatus;
use App\Enums\EventFormat;
use Illuminate\Validation\Rules\Enum;

class UpdateEventRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public function rules(): array
    {
        return [

            'title' => [
                'sometimes',
                'string',
                'max:255'
            ],

            'theme' => [
                'nullable',
                'string',
                'max:255'
            ],

            'goal' => [
                'nullable',
                'string'
            ],
            'target_audience' => [
                'nullable',
                'string'
            ],
            'tickets_available' => [
                'nullable',
                'numeric'
            ],

            'description' => [
                'nullable',
                'string'
            ],
            'venue' => [
                'nullable',
                'string'
            ],

            'capacity' => [
                'nullable',
                'integer',
                'min:1'
            ],

            'format' => [
                'nullable',
                'string',
                new Enum(EventFormat::class),
            ],
            'status' => [
                'nullable',
                'string',
                new Enum(EventStatus::class),
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

        ];
    }

}
