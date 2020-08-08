<?php

namespace App\Http\Controllers;

use App\Company;
use App\TimeShift;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $user->load('companies');

        $dates = [
            'first_day' => new Carbon('today'),
            'second_day' => new Carbon('today + 1 day'),
            'third_day' => new Carbon('today + 2 days'),
            'fourth_day' => new Carbon('today + 3 days'),
            'fifth_day' => new Carbon('today + 4 days'),
            'sixth_day' => new Carbon('today + 5 days'),
            'seventh_day' => new Carbon('today + 6 days'),
        ];

        $companies = $user->companies;

        $companies->each(function ($company) use ($dates) {
            $company->load([
                'events' => function ($query) use ($dates) {
                    return $query->whereIn('date', array_values($dates));
                }
            ]);
        });
        
        $timeShifts = TimeShift::select('id', 'title')->get();

        $data = [];

        foreach ($companies as $company) {
            $temp = [];
            foreach ($timeShifts as $timeShift) {
                $events = [
                    $dates['first_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['first_day']);
                    })
                    ->first(),
                $dates['second_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['second_day']);
                    })
                    ->first(),
                $dates['third_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['third_day']);
                    })
                    ->first(),
                $dates['fourth_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['fourth_day']);
                    })
                    ->first(),
                $dates['fifth_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['fifth_day']);
                    })
                    ->first(),
                $dates['sixth_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['sixth_day']);
                    })
                    ->first(),
                $dates['seventh_day']->format('D, j M') => $company
                    ->events
                    ->filter(function ($event) use ($timeShift, $dates) {
                        return ($event->time_shift_id == $timeShift->id
                            && $event->date == $dates['seventh_day']);
                    })
                    ->first(),
                ];

                $temp[] = $events;
            }
            $data[] = $temp;
        }

        $formattedDates = [];

        foreach ($dates as $date) {
            $formattedDates[] = $date->format('D, j M');
        }

        return view('home', [
            'events' => $data,
            'dates' => $formattedDates,
            'timeShifts' => $timeShifts->toArray(),
            'companies' => $companies->toArray()
        ]);
    }
}
