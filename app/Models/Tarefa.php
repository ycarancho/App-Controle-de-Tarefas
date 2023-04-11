<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = ['tarefa', 'data_tarefa', 'user_id'];

    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
