<?php

use Carbon\Carbon;
use CarbonCarbon;
use Illuminate\Auth\EloquentUserProvider;

class BaseModel extends EloquentUserProvider {

    public function getCreatedAtAttribute($attr) {        
        return Carbon::parse($attr)->format('d/m/Y - h:ia'); //Change the format to whichever you desire
    }
}