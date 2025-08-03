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
    public $type, $filter;

    public function __construct($type, $filter)
    {
        // $this->judul = $judul;
        $this->type = $type;
        $this->filter = $filter;
        // $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-hapus-pelanggaran-channel');
    }

    public function broadcastAs()
    {
        return 'terima-hapus-pelanggaran';
    }
}


?>