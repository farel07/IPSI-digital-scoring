<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KirimPoinSeni implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $poin, $filter, $pertandingan_id, $type, $role;
    public function __construct($poin, $filter, $pertandingan_id, $type, $role)
    {
        $this->poin = $poin;
        $this->filter = $filter;
        $this->pertandingan_id = $pertandingan_id;
        $this->type = $type;
        $this->role = $role;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
     public function broadcastOn()
    {
        return new Channel('kirim-poin-seni-channel-' . $this->pertandingan_id);
    }

    public function broadcastAs()
    {
        return 'terima-poin-seni-' . $this->pertandingan_id;
    }
}
