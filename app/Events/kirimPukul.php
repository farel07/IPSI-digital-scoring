<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class kirimPukul implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public  $filter, $juri_ket, $pertandingan_id;

    public function __construct( $filter, $juri_ket, $pertandingan_id)
    {
        // $this->judul = $judul;
        $this->filter = $filter;
        $this->juri_ket = $juri_ket;
        $this->pertandingan_id = $pertandingan_id;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-pukul-channel-' . $this->pertandingan_id);
    }

    public function broadcastAs()
    {
        return 'terima-pukul-' . $this->pertandingan_id;
    }
}


?>