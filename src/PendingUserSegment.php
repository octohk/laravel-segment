<?php

namespace SlashEquip\LaravelSegment;

use SlashEquip\LaravelSegment\Contracts\CanBeIdentifiedForSegment;

class PendingUserSegment
{
    private SegmentService $service;

    private CanBeIdentifiedForSegment $user;

    public function __construct(SegmentService $service, CanBeIdentifiedForSegment $user)
    {
        $this->service = $service;
        $this->user = $user;
    }

    public function track(string $event, ?array $eventData = null, ?array $context = null): void
    {
        $this->service->push(
            new SimpleSegmentEvent(
                $this->user,
                $event,
                $eventData,
                $context
            )
        );
    }

    public function identify(?array $identifyData = null, ?array $context = null): void
    {
        $this->service->push(
            new SimpleSegmentIdentify($this->user, $identifyData, $context)
        );
    }
}
