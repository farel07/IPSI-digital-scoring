<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TimerUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pertandinganId;
    public $state; // 'playing', 'paused', 'reset'
    public $currentTime;
    public $totalDuration;

    /**
     * Membuat instance event baru.
     */
    public function __construct($pertandinganId, $state, $currentTime, $totalDuration)
    {
        $this->pertandinganId = $pertandinganId;
        $this->state = $state;
        $this->currentTime = $currentTime;
        $this->totalDuration = $totalDuration;
    }

    /**
     * Mendapatkan channel tempat event akan disiarkan.
     */
    public function broadcastOn(): array
    {
        // Channel ini privat, hanya untuk pertandingan spesifik
        return [
            new PrivateChannel('pertandingan.' . $this->pertandinganId),
        ];
    }
}
