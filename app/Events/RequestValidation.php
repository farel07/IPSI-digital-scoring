<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel; // <-- MENJADI INI (dari PrivateChannel)
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestValidation implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        // Ganti 'PrivateChannel' menjadi 'Channel' biasa
        return new Channel('pertandingan.' . $this->data['pertandingan_id']); // <-- GANTI INI
    }

    public function broadcastAs()
    {
        return 'terima-request-validation';
    }
}