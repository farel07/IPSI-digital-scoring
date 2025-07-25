<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifikasiDikirim implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $judul;
    public $pesan;

    public function __construct($judul, $pesan)
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
    }

    public function broadcastOn()
    {
        return new Channel('notifikasi-channel');
    }

    public function broadcastAs()
    {
        return 'notifikasi-terima';
    }
}


?>