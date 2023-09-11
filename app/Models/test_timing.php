<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_timing extends Model
{
    use HasFactory;
    protected $fillable = [
        'hosp_id',
        'user_id',
        'days',
        'timing',
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class,'hosp_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
      
    }
}
