<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectTicket extends Pivot
{
    protected $table = 'project_ticket';

    public function tickets()
    {
        return $this->belongsToMany('App\Models\v1\Ticket','project_id','ticket_id','project_ticket')->withTimestamps();
    }
}
