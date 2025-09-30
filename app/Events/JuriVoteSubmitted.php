<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JuriVoteSubmitted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pertandinganId;
    public $juriName; // e.g., 'juri-1'
    public $vote; // 'merah', 'biru', atau 'invalid'

    public function __construct(int $pertandinganId, string $juriName, string $vote)
    {
        $this->pertandinganId = $pertandinganId;
        $this->juriName = $juriName;
        $this->vote = $vote;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('pertandingan.' . $this->pertandinganId),
        ];
    }

    // public function broadcastAs(): string
    // {
    //     return 'JuriVoteSubmitted';
    // }
}
