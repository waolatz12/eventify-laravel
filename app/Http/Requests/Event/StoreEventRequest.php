<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;
use App\Enums\EventStatus;
use App\Enums\EventFormat;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'description' => ['required', 'string'],
            'venue' => ['required', 'string'],
            'date' => ['required', 'date'],
            'format' => [
                'required',
                new Enum(EventFormat::class),
            ],
            'status' => [
                'required',
                new Enum(EventStatus::class),
            ],
        ];
    }
}
