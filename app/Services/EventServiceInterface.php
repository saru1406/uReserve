<?php

namespace App\Services;

interface EventServiceInterface
{
    public function eventCheck($date, $startTime, $endTime);

    public function eventCount($date, $startTime, $endTime);

    public function eventCreate($eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible);

    public function eventUpdate($event, $eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible);
}
