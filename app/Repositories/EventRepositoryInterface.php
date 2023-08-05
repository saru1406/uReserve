<?php

namespace App\Repositories;

interface EventRepositoryInterface
{
    public function eventCheck($date, $startTime, $endTime);

    public function eventCount($date, $startTime, $endTime);

    public function dateFormat($date, $time);

    public function eventCreate($eventName, $information, $startTime, $endTime, $maxPeople, $isVisible);

    public function eventUpdate($event, $eventName, $information, $startTime, $endTime, $maxPeople, $isVisible);
}
