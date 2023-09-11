<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'hosp_id',
        'user_id',
        'status',
        'vaccination',
        'pdf_path', // Add pdf_path to the fillable array
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }
}
