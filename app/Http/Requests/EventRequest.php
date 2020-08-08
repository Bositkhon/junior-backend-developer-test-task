<?php

namespace App\Http\Requests;

use App\Company;
use App\Event;
use App\TimeShift;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_title' => [
                'required',
                'string'
            ],
            'cost' => [
                'required',
                'numeric'
            ],
            'project_type' => [
                'required',
                'string'
            ],
            'company_id' => [
                'required',
                'integer',
                Rule::exists('companies', 'id')->whereNull(Company::DELETED_AT)
            ],
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    $eventsCount = Event::whereDate('date', $date)->count();
                    if ($eventsCount >= 3) {
                        $fail('On the same date you may have no more than three events');
                    }
                }
            ],
            'time_shift_id' => [
                'required',
                'integer',
                Rule::exists('time_shifts', 'id')->whereNull(TimeShift::DELETED_AT),
                function ($attribute, $value, $fail) {
                    $eventRouteParam = $this->route('event');
                    $event = Event::whereDate('date', $this->get('date'))
                        ->where('company_id', $this->get('company_id'))
                        ->where('time_shift_id', $value)
                        ->when($eventRouteParam != null, function ($query) use ($eventRouteParam) {
                            return $query->where('id', '!=', $eventRouteParam->id);
                        })
                        ->first();
                    if ($event) {
                        $fail('Event with this date and time shift already exists');
                    }
                }
            ],
            'duty_holder_full_name' => [
                'required',
                'string'
            ]
        ];
    }

}
