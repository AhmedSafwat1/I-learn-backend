<?php

namespace Modules\Learn\Events;

use Illuminate\Queue\SerializesModels;

class HomeWorkSolutionEvent
{
    use SerializesModels;

    public $homework;
    public $update;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($homework, $update=false)
    {
        //
        $this->homework = $homework;
        $this->update   = $update;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
