<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisme extends Model
{
    protected $primaryKey = 'id_Organisme';
    protected $table = 'organisme';
    public $timestamps = false;
}
