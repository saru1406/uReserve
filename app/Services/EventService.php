<?php

namespace App\Services;

use App\Repositories\EventRepositoryInterface;
use App\Services\EventServiceInterface;
use Carbon\Carbon;

class EventService implements EventServiceInterface
{
    public function __construct(private EventRepositoryInterface $eventRepository)
    {
    }

    public function eventCheck($date, $startTime, $endTime)
    {
        return $this->eventRepository->eventCheck($date, $startTime, $endTime);
    }

    public function eventCount($date, $startTime, $endTime)
    {
        return $this->eventRepository->eventCount($date, $startTime, $endTime);
    }

    public function dateFormat($date, $time)
    {
        $dataFormat = $date . " " . $time;
        return Carbon::createFromFormat(
            'Y-m-d H:i',
            $dataFormat
        );
    }

    public function eventCreate($eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible)
    {
        $startTime = $this->eventRepository->dateFormat($eventDate, $startTime);
        $endTime = $this->eventRepository->dateFormat($eventDate, $endTime);
        return $this->eventRepository->eventCreate($eventName, $information, $startTime, $endTime, $maxPeople, $isVisible);
    }

    public function eventUpdate($event, $eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible)
    {
        $startTime = $this->eventRepository->dateFormat($eventDate, $startTime);
        $endTime = $this->eventRepository->dateFormat($eventDate, $endTime);
        return $this->eventRepository->eventUpdate($event, $eventName, $information, $startTime, $endTime, $maxPeople, $isVisible);
    }
}
