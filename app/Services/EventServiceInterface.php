<?php

namespace App\Services;

interface EventServiceInterface
{
    public function eventCheck($date, $startTime, $endTime);

    public function eventCreate($eventName, $information, $eventDate, $startTime, $endTime, $maxPeople, $isVisible);
}
