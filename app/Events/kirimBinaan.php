<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class kirimBinaan implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public $count, $filter, $pertandingan_id;

    public function __construct($count, $filter, $pertandingan_id)
    {
        // $this->judul = $judul;
        $this->count = $count;
        $this->filter = $filter;
        $this->pertandingan_id = $pertandingan_id;
        // $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-binaan-channel-' . $this->pertandingan_id);
    }

    public function broadcastAs()
    {
        return 'terima-binaan-' . $this->pertandingan_id;
    }
}


?>