<?php

namespace App\Listeners\Users;

use App\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateUserChannel
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Channel::create([
            'name'=>$event->user->name,
            'user_id'=>$event->user->id
        ]);
    }
}
