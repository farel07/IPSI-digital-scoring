<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JuryVoteSubmitted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        // Menyiarkan ke channel yang SAMA dengan request awal
        return new Channel('pertandingan.' . $this->data['pertandingan_id']);
    }

    public function broadcastAs()
    {
        // Memberi nama event yang jelas
        return 'terima-vote-juri';
    }
}