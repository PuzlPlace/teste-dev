<?php

namespace App\Listeners;

use App\Events\TaskSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TaskSaved  $event
     * @return void
     */
    public function handle(TaskSaved $event)
    {
        Mail::to($event->user)
            ->send(new \App\Mail\TaskSaved($event->msg));
    }
}
