<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $fillable = ['users','browsers','oses'];

    protected $table = 'pengunjungs';
}
