<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class kirimTendang implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $filter, $juri_ket;

    /**
     * Create a new event instance.
     */
    public function __construct($filter, $juri_ket)
    {
        $this->filter = $filter;
        $this->juri_ket = $juri_ket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('kirim-tendang-channel');
    }

    public function broadcastAs()
    {
        return 'terima-tendang';
    }
}
