<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'download';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'url', 'filename', 'download_state'];
}
