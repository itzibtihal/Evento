<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'ticket_price' => 'required|numeric',
            'lieu' => 'required|string',
            'total_tickets' => 'required|integer',
            'available_tickets' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'duration_of_event' => 'required|integer',
            'status_event' => 'required|in:auto-accepted,needs-acceptation',
            'type' => 'required|in:online,presentiel',
        ];
    }
}
