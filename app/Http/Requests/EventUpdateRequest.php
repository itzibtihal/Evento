<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'title' => 'string',
            'description' => 'string',
            'date' => 'date',
            'hour' => 'date_format:H:i',
            'ticket_price' => 'numeric',
            'lieu' => 'string',
            'total_tickets' => 'integer',
            'available_tickets' => 'integer',
            'category_id' => 'exists:categories,id',
            'duration_of_event' => 'integer',
            'status_event' => 'in:auto-accepted,needs-acceptation',
            'type' => 'in:online,presentiel',
        ];
    }
}
