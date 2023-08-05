<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function __construct(private EventServiceInterface $eventService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $events = DB::table('events')
            ->whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('manager.events.index')->with(['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $eventName = $request->getEventName();
        $information = $request->getInformation();
        $eventDate = $request->getEventDate();
        $startTime = $request->getStartTime();
        $endTime = $request->getEndTime();
        $maxPeople = $request->getMaxPeople();
        $isVisible = $request->getIsVisible();

        $check = $this->eventService->eventCheck($eventDate, $startTime, $endTime);

        if($check) { // 存在したら
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return view('manager.events.create');
        }

        $this->eventService->eventCreate($eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible);


        return to_route('events.index')->with(session()->flash('status', '登録完了'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = Event::findOrFail($event->id);
        // $eventDate = $event->eventDate;
        // $startTime = $event->startTime;
        // $endTime = $event->endTime;
        return view('manager.events.show')
            ->with([
                'event' => $event,
                // 'eventDate' => $eventDate,
                // 'startTime' => $startTime,
                // 'endTime' => $endTime
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $editEventDate = $event->editEventDate;
        $event = Event::findOrFail($event->id);

        return view('manager.events.edit')->with(['event' => $event, 'editEventDate' => $editEventDate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $eventName = $request->getEventName();
        $information = $request->getInformation();
        $eventDate = $request->getEventDate();
        $startTime = $request->getStartTime();
        $endTime = $request->getEndTime();
        $maxPeople = $request->getMaxPeople();
        $isVisible = $request->getIsVisible();

        $count = $this->eventService->eventCount($eventDate, $startTime, $endTime);

        if($count > 1) {
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return to_route('events.edit', ['event'=>$event->id]);
        }

        $this->eventService->eventUpdate($event, $eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible);

        return to_route('events.show', [$event->id])->with(session()->flash('status', '変更完了'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function past()
    {
        $today = Carbon::today();
        $events = DB::table('events')
            ->whereDate('start_date', '<', $today)
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('manager.events.past')->with([
            'events' => $events
        ]);
    }
}
