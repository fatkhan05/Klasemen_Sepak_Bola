<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataClub extends Model
{
    use HasFactory;

    protected $table = 'data_club';
    protected $primaryKey = 'id_club';
    protected $guarded = ['id_club'];
}
