<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class kirimJatuh implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $judul;
    public $isi;

    public function __construct($isi)
    {
        // $this->judul = $judul;
        $this->isi = $isi;
        // $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('kirim-jatuh-channel');
    }

    public function broadcastAs()
    {
        return 'terima-jatuh';
    }
}


?>