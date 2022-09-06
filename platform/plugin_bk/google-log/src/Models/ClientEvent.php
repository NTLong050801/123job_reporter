<?php

namespace Workable\GoogleLog\Models;

use Illuminate\Database\Eloquent\Model;

class ClientEvent extends Model
{
    protected $table='client_events';
    protected $guarded = ['id'];
    protected $fillable = [];

}
