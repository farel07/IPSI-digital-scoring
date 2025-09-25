<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class hapusPelanggaran implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public $type, $filter, $pertandingan_id;

    public function __construct($type, $filter, $pertandingan_id)
    {
        // $this->judul = $judul;
        $this->type = $type;
        $this->filter = $filter;
        $this->pertandingan_id = $pertandingan_id;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-hapus-pelanggaran-channel-' . $this->pertandingan_id);
    }

    public function broadcastAs()
    {
        return 'terima-hapus-pelanggaran-' . $this->pertandingan_id;
    }
}


?>