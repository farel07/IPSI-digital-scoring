<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class hapusPoint implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public $type, $filter, $juri_ket;

    public function __construct($filter, $type, $juri_ket)
    {
        // $this->judul = $judul;
        $this->filter = $filter;
        $this->type = $type;
        $this->juri_ket = $juri_ket;
        // $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-hapus-point-channel');
    }

    public function broadcastAs()
    {
        return 'terima-hapus-point';
    }
}


?>