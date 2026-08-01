<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'numeric', 'exists:tickets,id'],
            'slug' => ['required', 'string', 'unique:events,slug'],
            'description' => ['required', 'string'],
            'venue' => ['required', 'string'],
            'date' => ['required', 'date'],
        ];
    }
}
