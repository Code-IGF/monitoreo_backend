<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NuevoLog implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $tipo;
    public $nombreChannel;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tipo,$nombreChannel)
    {
        $this->tipo = $tipo;
        $this->nombreChannel = $nombreChannel;
    }
/*     public function broadcastWith() {
        return [
            "tipo" => $this->tipo,
            "nombreChannel" => $this->nombreChannel,
        ];
    } */

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("usuario") ;
    }
}