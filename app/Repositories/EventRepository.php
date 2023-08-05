<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\EventRepositoryInterface;
use Carbon\Carbon;

class EventRepository implements EventRepositoryInterface
{
    public function eventCheck($date, $startTime, $endTime)
    {
        return Event::whereDate('start_date', $date) // 日にち
            ->whereTime('end_date', '>', $startTime)
            ->whereTime('start_date', '<', $endTime)
            ->exists(); // 存在確認
    }

    public function eventCount($date, $startTime, $endTime)
    {
        return Event::whereDate('start_date', $date) // 日にち
            ->whereTime('end_date', '>', $startTime)
            ->whereTime('start_date', '<', $endTime)
            ->count();
    }

    public function dateFormat($date, $time)
    {
        $dataFormat = $date . " " . $time;
        return Carbon::createFromFormat(
            'Y-m-d H:i',
            $dataFormat
        );
    }

    public function eventCreate($eventName, $information, $startTime, $endTime, $maxPeople, $isVisible)
    {
        return Event::create([
            'name' => $eventName,
            'information' => $information,
            'start_date' => $startTime,
            'end_date' => $endTime,
            'max_people' => $maxPeople,
            'is_visible' => $isVisible,
        ]);
    }

    public function eventUpdate($event, $eventName, $information, $startTime, $endTime, $maxPeople, $isVisible)
    {
        return Event::where('id', $event->id)
            ->update([
                'name' => $eventName,
                'information' => $information,
                'start_date' => $startTime,
                'end_date' => $endTime,
                'max_people' => $maxPeople,
                'is_visible' => $isVisible,
            ]);
    }
}
