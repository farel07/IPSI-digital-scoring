<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DewanRequestValidation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pertandinganId;
    public $jenisValidasi; // 'jatuhan' atau 'pelanggaran'

    public function __construct(int $pertandinganId, string $jenisValidasi)
    {
        $this->pertandinganId = $pertandinganId;
        $this->jenisValidasi = $jenisValidasi;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('pertandingan.' . $this->pertandinganId),
        ];
    }

    // public function broadcastAs(): string
    // {
    //     return 'DewanRequestValidation';
    // }
}
