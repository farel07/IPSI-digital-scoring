<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class kirimTeguran implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public $count, $filter, $pertandingan_id;

    public function __construct($count, $filter, $pertandingan_id)
    {
        // $this->judul = $judul;
        $this->count = $count;
        $this->pertandingan_id = $pertandingan_id;
        $this->filter = $filter;
        // $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-teguran-channel-' . $this->pertandingan_id);
    }

    public function broadcastAs()
    {
        return 'terima-teguran-' . $this->pertandingan_id;
    }
}


?>