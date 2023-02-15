<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_reservation extends Model
{
    protected $primaryKey = 'code_reservation';
    protected $table = 'details_reservation';
    public $timestamps = false;
}
