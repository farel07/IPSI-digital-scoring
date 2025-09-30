<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoundUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pertandinganId;
    public $newRoundNumber;

    /**
     * Membuat instance event baru.
     */
    public function __construct(int $pertandinganId, int $newRoundNumber)
    {
        $this->pertandinganId = $pertandinganId;
        $this->newRoundNumber = $newRoundNumber;
    }

    /**
     * Mendapatkan channel tempat event akan disiarkan.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('pertandingan.' . $this->pertandinganId),
        ];
    }

    // public function broadcastAs(): string
    // {
    //     return 'RoundUpdated';
    // }
}
