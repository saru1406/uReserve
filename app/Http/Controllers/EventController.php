<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->paginate(10);
        // $events = DB::table('events')
        // ->orderBy('start_date', 'asc') //開始日時順
        // ->paginate(10);
        // dd($events);
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
        $check = Event::whereDate('start_date', $request['event_date']) // 日にち
            ->whereTime('end_date', '>', $request['start_time'])
            ->whereTime('start_date', '<', $request['end_time'])
            ->exists(); // 存在確認
        // dd($check);
        if($check) { // 存在したら
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return view('manager.events.create');
        }

        $start = $request['event_date'] . " " . $request['start_time'];
        $end = $request['event_date'] . " " . $request['end_time'];
        $startDate = Carbon::createFromFormat(
            'Y-m-d H:i',
            $start
        );

        $endDate = Carbon::createFromFormat(
            'Y-m-d H:i',
            $end
        );

        Event::create([
            'name' => $request['event_name'],
            'information' => $request['information'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'max_people' => $request['max_people'],
            'is_visible' => $request['is_visible'],
            ]);
        session()->flash('status', '登録okです');
        return to_route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
