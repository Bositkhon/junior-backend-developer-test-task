<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventRequest;
use App\TimeShift;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = auth()->user()->events()->latest()->get();

        return view('events.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = auth()->user()->companies;
        $timeShifts = TimeShift::all();
        return view('events.create', [
            'companies' => $companies,
            'timeShifts' => $timeShifts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        auth()->user()->events()->create($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', __('messages.store_success', ['model' => 'Event']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $companies = auth()->user()->companies;
        $timeShifts = TimeShift::all();
        return view('events.edit', [
            'event' => $event,
            'companies' => $companies,
            'timeShifts' => $timeShifts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());

        return redirect()
            ->back()
            ->with('success', __('messages.update_success', ['model' => 'Event']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', __('messages.destroy_success', ['model' => 'Event']));
    }
}
