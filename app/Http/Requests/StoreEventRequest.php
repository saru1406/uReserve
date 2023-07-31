<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => ['required', 'max:50'],
            'information' => ['required', 'max:200'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'max_people' => ['required', 'numeric', 'between:1,20'],
            'is_visible' => ['required', 'boolean']
        ];
    }

    public function getEventName()
    {
        return $this->input('event_name');
    }

    public function getInformation()
    {
        return $this->input('information');
    }

    public function getEventDate()
    {
        return $this->input('event_date');
    }

    public function getStartTime()
    {
        return $this->input('start_time');
    }

    public function getEndTime()
    {
        return $this->input('end_time');
    }

    public function getMaxPeople()
    {
        return $this->input('max_people');
    }

    public function getIsVisible()
    {
        return $this->input('is_visible');
    }
}
